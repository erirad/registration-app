<?php
namespace App\Model;

use App\Core\Model;

class Consultant extends Model
{

    public function getConsultant($id)
    {
        $sql = "SELECT * FROM consultants WHERE id = :id";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetch();
    }

    public function getAllConsultants()
    {
        $sql = "SELECT * FROM consultants";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

?>
