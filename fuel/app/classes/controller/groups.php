<?php

/**
 * Controller Group.
 *
 * Controller yang mengelola bagian profil ideal Kelompok Peminatan
 *
 * @package  app
 * @extends  Controller_Template
 */

class Controller_Groups extends Controller_Template
{
	/**
	 * Halaman daftar Kelompok Peminatan
	 *
	 * @access  public
	 * @return  object
	 */

	public function action_index()
	{
		$this->template->title = 'Profil Ideal Kelompok Peminatan';
		$this->template->content = ViewModel::forge('groups/index');
	}

	/**
	 * Sunting dan perbarui Kelompok Peminatan
	 *
	 * @access  public
	 * @return  object
	 */

	public function action_edit($id = null)
	{
		// Cek apakah Kelompok Peminatan tersedia
		if ( ! $group = Model_Group::find($id) )
		{
			Session::set_flash('danger', 'Maaf, kami tidak dapat menemukan Kelompok Peminatan #'.$id);
			return Response::redirect('groups');
		}

		// Validasi masukan
		$val = Validation::forge();

		$val->add_field('name', 'Nama Kelompok Peminatan', 'required');
		$val->add_field('raport_pai', 'Raport Pend. Agama Islam', 'required|numeric_between[0,10]');
		$val->add_field('raport_bin', 'Raport Bahasa Indonesia', 'required|numeric_between[0,10]');
		$val->add_field('raport_big', 'Raport Bahasa Inggris', 'required|numeric_between[0,10]');
		$val->add_field('raport_mtk', 'Raport Matematika', 'required|numeric_between[0,10]');
		$val->add_field('raport_ipa', 'Raport IPA', 'required|numeric_between[0,10]');
		$val->add_field('raport_ips', 'Raport IPS', 'required|numeric_between[0,10]');
		$val->add_field('un_bin', 'UN Bahasa Indonesia', 'required|numeric_between[0,10]');
		$val->add_field('un_big', 'UN Bahasa Inggris', 'required|numeric_between[0,10]');
		$val->add_field('un_mtk', 'UN Matematika', 'required|numeric_between[0,10]');
		$val->add_field('un_ipa', 'UN IPA', 'required|numeric_between[0,10]');
		$val->add_field('tpa', 'Tes Potensi Akademik', 'required|numeric_between[0,10]');
		$val->add_field('bta', 'Baca Tulis Al-Qur\'an', 'required|numeric_between[0,10]');
		$val->add_field('iq', 'Skor IQ', 'required|numeric_between[0,10]');

		if ($val->run())
		{
			$fields = $val->validated();

			// Siapkan data yang akan disimpan
			$group->name = $fields['name'];
			$group->raport_pai = $fields['raport_pai'];
			$group->raport_bin = $fields['raport_bin'];
			$group->raport_big = $fields['raport_big'];
			$group->raport_mtk = $fields['raport_mtk'];
			$group->raport_ipa = $fields['raport_ipa'];
			$group->raport_ips = $fields['raport_ips'];
			$group->un_bin = $fields['un_bin'];
			$group->un_big = $fields['un_big'];
			$group->un_mtk = $fields['un_mtk'];
			$group->un_ipa = $fields['un_ipa'];
			$group->tpa = $fields['tpa'];
			$group->bta = $fields['bta'];
			$group->iq = $fields['iq'];

			if ($group->save())
			{
				Session::set_flash('success', 'Telah menambahkan Kelompok Peminatan #'.$group->id);
			}
			else
			{
				Session::set_flash('danger', 'Gagal menambahkan Kelompok Peminatan');
			}

			Response::redirect('groups');
		}
		else
		{
			$this->template->messages = $val->error();
		}

		$data = array();
		$data['group'] = $group;

		$this->template->title = 'Profil Ideal Kelompok Peminatan '.$group->name;
		$this->template->content = View::forge('groups/edit', $data);
	}
}