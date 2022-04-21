<?php
require_once(ROOT_PATH .'/Models/ryokan.php');

class RyokanController {
    private $request;
    private $Ryokan;

    public function __construct() {
      if(!isset($_SESSION['login_user'])) {
        header('Location: /front_page/login.php');
      }
      
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;

        $this->Ryokan = new Ryokan();
    }

    public function index() {
        $hukuoka = $this->Ryokan->hukuoka_inf();
        $oita = $this->Ryokan->oita_inf();
        $saga = $this->Ryokan->saga_inf();
        $nagasaki = $this->Ryokan->nagasaki_inf();
        $kumamoto = $this->Ryokan->kumamoto_inf();
        $miyazaki = $this->Ryokan->miyazaki_inf();
        $kagosima = $this->Ryokan->kagosima_inf();
        $Ryokan_count = $this->Ryokan->countAll();
        $params = [
            'hukuoka' => $hukuoka,
            'oita' => $oita,
            'saga' => $saga,
            'nagasaki' => $nagasaki,
            'kumamoto' => $kumamoto,
            'miyazaki' => $miyazaki,
            'kagosima' => $kagosima,
            'pages' => $Ryokan_count / 10
        ];
        return $params;
    }

    public function view() {
        if(empty($this->request['get']['id'])) {
          echo "指定のパラメータが不正です。このページを表示できません。";
          exit;
        }
        $ryokan_id = $this->Ryokan->findById($this->request['get']['id']);
        $params = [
          'ryokan' => $ryokan_id
        ];
        return $params;
      }

      public function editUp() {
        if (empty($this->request['get']['id'])) {
                echo '指定のパラメータが不正です。このページを表示できません。';
                exit;
            }
    
        $update = $this->Ryokan->update($this->request['post']['id']);
        $params = [
          'ryokan' => $updeta
        ];
        return $params;
      }

      public function ryokan_delete() {
        if(empty($this->request['get']['id'])) {
          return;
        }
        $delete = $this->Ryokan->delete();
        return $delete;
      }
    }
