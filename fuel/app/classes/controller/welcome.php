<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Welcome extends Controller_Template
{

	/**
	 * Halaman beranda
	 *
	 * @access  public
	 * @return  object
	 */
	public function action_index()
	{
		$this->template->title = 'Beranda';
		$this->template->content = View::forge('welcome/index');
	}

	/**
	 * Tampilkan halaman pengaturan Profile Matching
	 *
	 * @access  public
	 * @return  object
	 */
	public function action_settings()
	{
		// Ambil data dari tabel
		$setting = Model_Setting::find(1);

		// Hasilkan form berdasarkan Model_Setting
		$fieldset = Fieldset::forge()->add_model($setting)->populate($setting);
		$form = $fieldset->form();
		$form->add('submit', '&nbsp;', array('type' => 'submit', 'value' => 'Simpan Perubahan', 'class' => 'btn btn-lg btn-success pull-right'));

		// Validasi masukan
		if ($fieldset->validation()->run() == true)
		{
			$fields = $fieldset->validated();

			$setting->core = $fields['core'];
			$setting->secondary = $fields['secondary'];
			$setting->raport = $fields['raport'];
			$setting->un = $fields['un'];
			$setting->umum = $fields['umum'];

			// Simpan perubahan
			if ($setting->save())
			{
				Session::set_flash('success', 'Perubahan telah disimpan.');
				Response::redirect('settings');
			}
		}
		else
		{
			$this->template->messages = $fieldset->validation()->error();
		}

		$data['settings'] = $form->build();
		$this->template->title = 'Pengaturan Profile Matching';
		$this->template->content = View::forge('welcome/settings', $data, false);
	}

	/**
	 * The 404 action for the application.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_404()
	{
		return Response::forge(ViewModel::forge('welcome/404'), 404);
	}
}
