<?php 
class Dashboard extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library(['auth']);

        // Check Login
        $this->auth->authenticate();
	}
	
	public function index(){
		if(hasRole('admin')){
			return redirect('admin');
		}else if(hasRole('horeka')){
			return redirect('horeka');
		}else{
			return redirect('login');
		}
	}
}
?>