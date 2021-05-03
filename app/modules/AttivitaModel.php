<?php


namespace app\modules;


class AttivitaModel extends BaseModel
{
    protected $table = 'attivita';

    public function getFsn(){
        $result = ['data' => null, 'status' => 0, 'message' => ''];
        try {
            $query = $this->conn->query("SELECT id, sigla, esteso FROM 01_federazione");
            $result['data'] = $query->fetchAll();
        }catch (Exception $e){
            $result['status'] = 1;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }
}