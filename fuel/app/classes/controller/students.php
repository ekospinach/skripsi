<?php

/**
 * Controller Students.
 *
 * Controller yang mengelola proses pemilihan Kelompok Peminatan
 *
 * @package  app
 * @extends  Controller_Template
 */

class Controller_Students extends Controller_Template
{
	/**
	 * Halaman daftar siswa
	 *
	 * @access  public
	 * @return  object
	 */

	public function action_index()
	{
		$this->template->title = 'Daftar Calon PDB';
		$this->template->content = ViewModel::forge('students/index');
	}

	/**
	 * Halaman daftar siswa berdasarkan Kelompok Peminatan
	 *
	 * @access  public
	 * @return  object
	 */

	public function action_group($group = null)
	{
		// Cek apakah Kelompok Peminatan tersedia
		if ( ! $students = Model_Student::find('all', array('related' => array('result'), 'where' => array(array('suggestion', $group)))) )
		{
			Session::set_flash('danger', 'Maaf, kami tidak dapat menemukan daftar Kelompok Peminatan '.$group);
			return Response::redirect('students');
		}

		$data = array();
		$data['students'] = $students;

		$this->template->title = 'Kelompok Peminatan '.$group;
		$this->template->content = View::forge('students/group', $data);
	}

	/**
	 * Halaman tambahkan siswa baru
	 *
	 * @access  public
	 * @return  object
	 */

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			// Validasi masukan
			$val = Validation::forge();

			$val->add_field('name', 'Nama Lengkap', 'required');
			$val->add_field('raport_pai', 'Raport PAI', 'required');
			$val->add_field('raport_bin', 'Raport BIN', 'required');
			$val->add_field('raport_big', 'Raport BIG', 'required');
			$val->add_field('raport_mtk', 'Raport MTK', 'required');
			$val->add_field('raport_ipa', 'Raport IPA', 'required');
			$val->add_field('raport_ips', 'Raport IPS', 'required');
			$val->add_field('un_bin', 'UN BIN', 'required');
			$val->add_field('un_big', 'UN BIG', 'required');
			$val->add_field('un_mtk', 'UN MTK', 'required');
			$val->add_field('un_ipa', 'UN IPA', 'required');
			$val->add_field('tpa', 'Potensi Akademik', 'required|numeric_between[0,100]');
			$val->add_field('bta', 'BTA', 'required|numeric_between[0,100]');
			$val->add_field('iq', 'IQ', 'required|numeric_between[0,300]');

			if ($val->run())
			{
				$fields = $val->validated();

				// Siapkan data untuk Profile Matching
				$tpa = $fields['tpa']/10;
				$bta = $fields['bta']/10;
				$iq = $this->hitung_iq($fields['iq']);

				$nilai = array(
					'raport_pai' => round($fields['raport_pai']),
					'raport_bin' => round($fields['raport_bin']),
					'raport_big' => round($fields['raport_big']),
					'raport_mtk' => round($fields['raport_mtk']),
					'raport_ipa' => round($fields['raport_ipa']),
					'raport_ips' => round($fields['raport_ips']),
					'un_bin' => round($fields['un_bin']),
					'un_big' => round($fields['un_big']),
					'un_mtk' => round($fields['un_mtk']),
					'un_ipa' => round($fields['un_ipa']),
					'tpa' => round($tpa),
					'bta' => round($bta),
					'iq' => $iq,
				);

				// Proses Profile Matching
				$hasil_1 = $this->profile_matching(Input::post('group_1'), $nilai);
				$hasil_2 = $this->profile_matching(Input::post('group_2'), $nilai);

				// Simpan data siswa ke dalam tabel students
				$student = new Model_Student(array(
					'name' => $fields['name'],
					'group_1' => Input::post('group_1'),
					'group_2' => Input::post('group_2'),
					'suggestion' => $hasil_1['total'] >= $hasil_2['total'] ? Input::post('group_1') : Input::post('group_2'),
				));

				// Simpan nilai siswa ke dalam tabel scores
				$student->score = new Model_Score(array(
					'raport_pai' => $fields['raport_pai'],
					'raport_bin' => $fields['raport_bin'],
					'raport_big' => $fields['raport_big'],
					'raport_mtk' => $fields['raport_mtk'],
					'raport_ipa' => $fields['raport_ipa'],
					'raport_ips' => $fields['raport_ips'],
					'un_bin' => $fields['un_bin'],
					'un_big' => $fields['un_big'],
					'un_mtk' => $fields['un_mtk'],
					'un_ipa' => $fields['un_ipa'],
					'tpa' => $fields['tpa'],
					'bta' => $fields['bta'],
					'iq' => $fields['iq'],
				));

				// Simpan nilai hasil profile matching ke dalam tabel results
				$student->result = new Model_Result(array(
					'raport_1' => $hasil_1['raport'],
					'un_1' => $hasil_1['un'],
					'umum_1' => $hasil_1['umum'],
					'total_1' => $hasil_1['total'],
					'raport_2' => $hasil_2['raport'],
					'un_2' => $hasil_2['un'],
					'umum_2' => $hasil_2['umum'],
					'total_2' => $hasil_2['total'],
				));

				if ($student->save())
				{
					Session::set_flash('success', 'Telah menambahkan siswa #'.$student->id);
				}
				else
				{
					Session::set_flash('danger', 'Gagal menambahkan siswa');
				}

				Response::redirect('students/create');
			}
			else
			{
				$this->template->messages = $val->error();
			}
		}

		$data = array();
		$data['group'] = array('AGAMA' => 'AGAMA', 'MIA' => 'MIA', 'IIS' => 'IIS');

		$this->template->title = 'Tambah Siswa';
		$this->template->content = View::forge('students/create', $data);
	}

	/**
	 * Halaman detail siswa
	 *
	 * @access  public
	 * @return  object
	 */

	public function action_detail($id = null)
	{
		// Cek apakah siswa tersedia
		if ( ! $student = Model_Student::find($id, array('related' => array('score', 'result'))) )
		{
			Session::set_flash('danger', 'Maaf, kami tidak dapat menemukan siswa #'.$id);
			return Response::redirect('students');
		}

		$data = array();
		$data['student'] = $student;

		$this->template->title = $student->name;
		$this->template->content = View::forge('students/detail', $data);
	}

	/**
	 * Sunting dan perbarui data siswa
	 *
	 * @access  public
	 * @return  object
	 */

	public function action_edit($id = null)
	{
		// Cek apakah siswa tersedia
		if ( ! $student = Model_Student::find($id, array('related' => array('score', 'result'))) )
		{
			Session::set_flash('danger', 'Maaf, kami tidak dapat menemukan siswa #'.$id);
			return Response::redirect('students');
		}

		// Validasi masukan
		$val = Validation::forge();

		$val->add_field('name', 'Nama Lengkap', 'required');
		$val->add_field('raport_pai', 'Raport PAI', 'required');
		$val->add_field('raport_bin', 'Raport BIN', 'required');
		$val->add_field('raport_big', 'Raport BIG', 'required');
		$val->add_field('raport_mtk', 'Raport MTK', 'required');
		$val->add_field('raport_ipa', 'Raport IPA', 'required');
		$val->add_field('raport_ips', 'Raport IPS', 'required');
		$val->add_field('un_bin', 'UN BIN', 'required');
		$val->add_field('un_big', 'UN BIG', 'required');
		$val->add_field('un_mtk', 'UN MTK', 'required');
		$val->add_field('un_ipa', 'UN IPA', 'required');
		$val->add_field('tpa', 'Potensi Akademik', 'required|numeric_between[0,100]');
		$val->add_field('bta', 'BTA', 'required|numeric_between[0,100]');
		$val->add_field('iq', 'IQ', 'required|numeric_between[0,300]');

		if ($val->run())
		{
			$fields = $val->validated();

			// Siapkan data untuk Profile Matching
			$tpa = $fields['tpa']/10;
			$bta = $fields['bta']/10;
			$iq = $this->hitung_iq($fields['iq']);

			$nilai = array(
				'raport_pai' => round($fields['raport_pai']),
				'raport_bin' => round($fields['raport_bin']),
				'raport_big' => round($fields['raport_big']),
				'raport_mtk' => round($fields['raport_mtk']),
				'raport_ipa' => round($fields['raport_ipa']),
				'raport_ips' => round($fields['raport_ips']),
				'un_bin' => round($fields['un_bin']),
				'un_big' => round($fields['un_big']),
				'un_mtk' => round($fields['un_mtk']),
				'un_ipa' => round($fields['un_ipa']),
				'tpa' => round($tpa),
				'bta' => round($bta),
				'iq' => $iq,
			);

			// Proses Profile Matching
			$hasil_1 = $this->profile_matching(Input::post('group_1'), $nilai);
			$hasil_2 = $this->profile_matching(Input::post('group_2'), $nilai);

			// Simpan data siswa ke dalam tabel students
			$student->name = $fields['name'];
			$student->group_1 = Input::post('group_1');
			$student->group_2 = Input::post('group_2');
			$student->suggestion = $hasil_1['total'] >= $hasil_2['total'] ? Input::post('group_1') : Input::post('group_2');

			// Simpan nilai siswa
			$student->score->raport_pai = $fields['raport_pai'];
			$student->score->raport_bin = $fields['raport_bin'];
			$student->score->raport_big = $fields['raport_big'];
			$student->score->raport_mtk = $fields['raport_mtk'];
			$student->score->raport_ipa = $fields['raport_ipa'];
			$student->score->raport_ips = $fields['raport_ips'];
			$student->score->un_bin = $fields['un_bin'];
			$student->score->un_big = $fields['un_big'];
			$student->score->un_mtk = $fields['un_mtk'];
			$student->score->un_ipa = $fields['un_ipa'];
			$student->score->tpa = $fields['tpa'];
			$student->score->bta = $fields['bta'];
			$student->score->iq = $fields['iq'];

			// Simpan hasil profile matching
			$student->result->raport_1 = $hasil_1['raport'];
			$student->result->un_1 = $hasil_1['un'];
			$student->result->umum_1 = $hasil_1['umum'];
			$student->result->total_1 = $hasil_1['total'];
			$student->result->raport_2 = $hasil_2['raport'];
			$student->result->un_2 = $hasil_2['un'];
			$student->result->umum_2 = $hasil_2['umum'];
			$student->result->total_2 = $hasil_2['total'];

			if ($student->save())
			{
				Session::set_flash('success', 'Perubahan data siswa #'.$student->id.' telah disimpan.');
			}
			else
			{
				Session::set_flash('danger', 'Gagal menyimpan perubahan data siswa');
			}

			Response::redirect('students');
		}
		else
		{
			$this->template->messages = $val->error();
		}

		$data = array();
		$data['student'] = $student;
		$data['group'] = array('AGAMA' => 'AGAMA', 'MIA' => 'MIA', 'IIS' => 'IIS');

		$this->template->title = $student->name.' | Sunting';
		$this->template->content = View::forge('students/edit', $data);
	}

	/**
	 * Hapus data siswa
	 *
	 * @access  public
	 * @return  object
	 */

	public function action_delete($id = null)
	{
		// Cek apakah siswa tersedia
		if ( ! $student = Model_Student::find($id) )
		{
			Session::set_flash('danger', 'Maaf, kami tidak dapat menemukan siswa #'.$id);
			return Response::redirect('students');
		}

		// Ha[us juga data yang berkaitan
		$score = DB::delete('scores')->where('student_id', $id)->execute();
		$result = DB::delete('results')->where('student_id', $id)->execute();

		if ($student->delete() and $score and $result)
		{
			Session::set_flash('success', 'Telah menghapus siswa #'.$id);
		}
		else
		{
			Session::set_flash('danger', 'Gagal menghapus siswa #'.$id);
		}

		Response::redirect('students');
	}

	/**
	 * Konversi skor IQ ke skala 1-10
	 *
	 * @access  public
	 * @param 	integer $skor_iq
	 * @return  integer
	 */

	public function hitung_iq($skor_iq)
	{
		switch ($skor_iq) {
			case $skor_iq > 139 and $skor_iq < 170:
				return 10;
				break;

			case $skor_iq > 119 and $skor_iq < 140:
				return 9;
				break;

			case $skor_iq > 109 and $skor_iq < 120:
				return 8;
				break;

			case $skor_iq > 89 and $skor_iq < 110:
				return 7;
				break;

			case $skor_iq > 79 and $skor_iq < 90:
				return 6;
				break;
			
			default:
				return 5;
				break;
		}
	}

	/**
	 * Penghitungan nilai siswa menggunakan Profile Matching
	 *
	 * @access  public
	 * @param 	string  $minat
	 * @param 	array $nilai
	 * @return  array
	 */

	public function profile_matching($minat, $nilai)
	{
		// Hitung nilai gap
		$gap = $this->hitung_gap($minat, $nilai);
		// Hitung nilai bobot
		$bobot = $this->hitung_bobot($gap);
		// Hitung nilai total tiap kriteria
		$kriteria = $this->hitung_kriteria($minat, $bobot);
		// Hitung nilai total
		$total = $this->hitung_total($kriteria);

		$hasil = array(
			'raport' => $kriteria['raport'],
			'un' => $kriteria['un'],
			'umum' => $kriteria['umum'],
			'total' => $total,
		);

		return $hasil;
	}

	/**
	 * Hitung nilai gap
	 *
	 * @access  public
	 * @param 	string  $minat
	 * @param 	array $nilai
	 * @return  array
	 */

	public function hitung_gap($minat, $nilai)
	{
		$gap = array();

		$profil = Model_Group::query()->where('name', $minat)->get_one();

		$gap[] = $nilai['raport_pai'] - $profil->raport_pai;
		$gap[] = $nilai['raport_bin'] - $profil->raport_bin;
		$gap[] = $nilai['raport_big'] - $profil->raport_big;
		$gap[] = $nilai['raport_mtk'] - $profil->raport_mtk;
		$gap[] = $nilai['raport_ipa'] - $profil->raport_ipa;
		$gap[] = $nilai['raport_ips'] - $profil->raport_ips;

		$gap[] = $nilai['un_bin'] - $profil->un_bin;
		$gap[] = $nilai['un_big'] - $profil->un_big;
		$gap[] = $nilai['un_mtk'] - $profil->un_mtk;
		$gap[] = $nilai['un_ipa'] - $profil->un_ipa;

		$gap[] = $nilai['tpa'] - $profil->tpa;
		$gap[] = $nilai['bta'] - $profil->bta;
		$gap[] = $nilai['iq'] - $profil->iq;

		// Simpan proses penghitungan
		DB::insert('dummy_gap')->set($gap)->execute();

		return $gap;
	}

	/**
	 * Konversi nilai gap ke nilai bobot
	 *
	 * @access  public
	 * @param 	array  $gap
	 * @return  array
	 */

	public function hitung_bobot($gap)
	{
		$bobot = array();

		for ($i=0; $i < 13; $i++)
		{ 
			switch ($gap[$i]) {
				case 0:
					$bobot[] = 5;
					break;

				case 1:
					$bobot[] = 4.5;
					break;

				case -1:
					$bobot[] = 4;
					break;

				case 2:
					$bobot[] = 3.5;
					break;

				case -2:
					$bobot[] = 3;
					break;

				case 3:
					$bobot[] = 2.5;
					break;

				case -3:
					$bobot[] = 2;
					break;

				case 4:
					$bobot[] = 1.5;
					break;

				case -4:
					$bobot[] = 1;
					break;

				case 5:
					$bobot[] = 0.5;
					break;
				
				default:
					$bobot[] = 0;
					break;
			}
		}

		// Simpan proses penghitungan
		DB::insert('dummy_bobot')->set($bobot)->execute();

		return $bobot;
	}

	/**
	 * Hitung nilai total tiap kriteria
	 *
	 * @access  public
	 * @param 	string  $minat
	 * @param 	array $bobot
	 * @return  array
	 */

	public function hitung_kriteria($minat, $bobot)
	{
		$kriteria = array();

		$factor = Model_Setting::find('first');
		$cf = $factor->core;
		$sf = $factor->secondary;

		switch ($minat) {
			case 'AGAMA':
				// Kriteria nilai raport
				$raport_core = array(
					'pai' => $bobot[0],
					'bin' => $bobot[1],
					'big' => $bobot[2],
					'mtk' => $bobot[3],
				);
				$jml_raport_core = count($raport_core);
				$total_raport_core = array_sum($raport_core);
				$ncf_raport = $total_raport_core/$jml_raport_core;

				$raport_secondary = array(
					'ipa' => $bobot[4],
					'ips' => $bobot[5],
				);
				$jml_raport_secondary = count($raport_secondary);
				$total_raport_secondary = array_sum($raport_secondary);
				$nsf_raport = $total_raport_secondary/$jml_raport_secondary;

				$nilai_raport = (($cf/100)*$ncf_raport) + (($sf/100)*$nsf_raport);
				$kriteria['raport'] = $nilai_raport;

				// Kriteria nilai Ujian Nasional
				$un_core = array(
					'bin' => $bobot[6],
					'mtk' => $bobot[8],
				);
				$jml_un_core = count($un_core);
				$total_un_core = array_sum($un_core);
				$ncf_un = $total_un_core/$jml_un_core;

				$un_secondary = array(
					'big' => $bobot[7],
					'ipa' => $bobot[9],
				);
				$jml_un_secondary = count($un_secondary);
				$total_un_secondary = array_sum($un_secondary);
				$nsf_un = $total_un_secondary/$jml_un_secondary;

				$nilai_un = (($cf/100)*$ncf_un) + (($sf/100)*$nsf_un);
				$kriteria['un'] = $nilai_un;

				// Kriteria nilai kompetensi umum
				$umum_core = array(
					'tpa' => $bobot[10],
					'bta' => $bobot[11],
				);
				$jml_umum_core = count($umum_core);
				$total_umum_core = array_sum($umum_core);
				$ncf_umum = $total_umum_core/$jml_umum_core;

				$umum_secondary = array(
					'iq' => $bobot[12],
				);
				$jml_umum_secondary = count($umum_secondary);
				$total_umum_secondary = array_sum($umum_secondary);
				$nsf_umum = $total_umum_secondary/$jml_umum_secondary;

				$nilai_umum = (($cf/100)*$ncf_umum) + (($sf/100)*$nsf_umum);
				$kriteria['umum'] = $nilai_umum;
				break;

			case 'MIA':
				// Kriteria nilai raport
				$raport_core = array(
					'bin' => $bobot[1],
					'big' => $bobot[2],
					'mtk' => $bobot[3],
					'ipa' => $bobot[4],
				);
				$jml_raport_core = count($raport_core);
				$total_raport_core = array_sum($raport_core);
				$ncf_raport = $total_raport_core/$jml_raport_core;

				$raport_secondary = array(
					'pai' => $bobot[0],
					'ips' => $bobot[5],
				);
				$jml_raport_secondary = count($raport_secondary);
				$total_raport_secondary = array_sum($raport_secondary);
				$nsf_raport = $total_raport_secondary/$jml_raport_secondary;

				$nilai_raport = (($cf/100)*$ncf_raport) + (($sf/100)*$nsf_raport);
				$kriteria['raport'] = $nilai_raport;

				// Kriteria nilai Ujian Nasional
				$un_core = array(
					'mtk' => $bobot[8],
					'ipa' => $bobot[9],
				);
				$jml_un_core = count($un_core);
				$total_un_core = array_sum($un_core);
				$ncf_un = $total_un_core/$jml_un_core;

				$un_secondary = array(
					'bin' => $bobot[6],
					'big' => $bobot[7],
				);
				$jml_un_secondary = count($un_secondary);
				$total_un_secondary = array_sum($un_secondary);
				$nsf_un = $total_un_secondary/$jml_un_secondary;

				$nilai_un = (($cf/100)*$ncf_un) + (($sf/100)*$nsf_un);
				$kriteria['un'] = $nilai_un;

				// Kriteria nilai kompetensi umum
				$umum_core = array(
					'tpa' => $bobot[10],
					'bta' => $bobot[11],
				);
				$jml_umum_core = count($umum_core);
				$total_umum_core = array_sum($umum_core);
				$ncf_umum = $total_umum_core/$jml_umum_core;

				$umum_secondary = array(
					'iq' => $bobot[12],
				);
				$jml_umum_secondary = count($umum_secondary);
				$total_umum_secondary = array_sum($umum_secondary);
				$nsf_umum = $total_umum_secondary/$jml_umum_secondary;

				$nilai_umum = (($cf/100)*$ncf_umum) + (($sf/100)*$nsf_umum);
				$kriteria['umum'] = $nilai_umum;
				break;
			
			default:
				// Kriteria nilai raport
				$raport_core = array(
					'bin' => $bobot[1],
					'big' => $bobot[2],
					'mtk' => $bobot[3],
					'ips' => $bobot[5],
				);
				$jml_raport_core = count($raport_core);
				$total_raport_core = array_sum($raport_core);
				$ncf_raport = $total_raport_core/$jml_raport_core;

				$raport_secondary = array(
					'pai' => $bobot[0],
					'ipa' => $bobot[4],
				);
				$jml_raport_secondary = count($raport_secondary);
				$total_raport_secondary = array_sum($raport_secondary);
				$nsf_raport = $total_raport_secondary/$jml_raport_secondary;

				$nilai_raport = (($cf/100)*$ncf_raport) + (($sf/100)*$nsf_raport);
				$kriteria['raport'] = $nilai_raport;

				// Kriteria nilai Ujian Nasional
				$un_core = array(
					'bin' => $bobot[6],
					'mtk' => $bobot[8],
				);
				$jml_un_core = count($un_core);
				$total_un_core = array_sum($un_core);
				$ncf_un = $total_un_core/$jml_un_core;

				$un_secondary = array(
					'big' => $bobot[7],
					'ipa' => $bobot[9],
				);
				$jml_un_secondary = count($un_secondary);
				$total_un_secondary = array_sum($un_secondary);
				$nsf_un = $total_un_secondary/$jml_un_secondary;

				$nilai_un = (($cf/100)*$ncf_un) + (($sf/100)*$nsf_un);
				$kriteria['un'] = $nilai_un;

				// Kriteria nilai kompetensi umum
				$umum_core = array(
					'tpa' => $bobot[10],
					'bta' => $bobot[11],
				);
				$jml_umum_core = count($umum_core);
				$total_umum_core = array_sum($umum_core);
				$ncf_umum = $total_umum_core/$jml_umum_core;

				$umum_secondary = array(
					'iq' => $bobot[12],
				);
				$jml_umum_secondary = count($umum_secondary);
				$total_umum_secondary = array_sum($umum_secondary);
				$nsf_umum = $total_umum_secondary/$jml_umum_secondary;

				$nilai_umum = (($cf/100)*$ncf_umum) + (($sf/100)*$nsf_umum);
				$kriteria['umum'] = $nilai_umum;
				break;
		}

		// Simpan proses penghitungan
		DB::insert('dummy_kriteria')->set($kriteria)->execute();

		return $kriteria;
	}

	/**
	 * Hitung nilai total tiap kriteria
	 *
	 * @access  public
	 * @param 	array $kriteria
	 * @return  array
	 */

	public function hitung_total($kriteria)
	{
		$factor = Model_Setting::find('first');
		$raport = $factor->raport;
		$un = $factor->un;
		$umum = $factor->umum;

		$total = (($raport/100)*$kriteria['raport']) + (($un/100)*$kriteria['un']) + (($umum/100)*$kriteria['umum']);

		// Simpan proses penghitungan
		DB::insert('dummy_total')->set(array('total' => $total))->execute();

		return $total;
	}
}