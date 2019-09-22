<?php
namespace App\Model;

use App\Core\Model;

class Client extends Model
{
    public function create(array $data): void
    {
        $key = $this->unicKey();
        $sql = "INSERT INTO clients (name, login_key, consultant_id) VALUES (:name, :login_key, :consultant_id)";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([
            'name' => $data['name'],
            'login_key' => $key,
            'consultant_id' => $data['consultant']
        ]);
    }

    private function unicKey(): ?string
    {
        $key = substr(md5(microtime()), rand(0, 26), 8);
        $sql = "SELECT COUNT(id) FROM clients WHERE login_key = :login_key";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([
            'login_key' => $key
        ]);
        $data = $stmt->fetch();
        if ($data['COUNT(id)'] > 0) {
            return $this->unicKey();
        }
        return $key;
    }

    public function getClient(string $loginKey, string $currentTime): ?array
    {
        $client = $this->getClientWithoutTimeLeft($loginKey, $currentTime);
        $average = $this->getDurationAverage($client['consultant_id']);

        return [$client, $average];
    }

    private function getClientWithoutTimeLeft(string $loginKey, string $currentTime): ?array
    {
        $sql = "SELECT *, TIME_TO_SEC(TIMEDIFF(:currentTime, created_at)) as timespend FROM clients WHERE login_key = :loginKey";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([
            'loginKey' => $loginKey,
            'currentTime' => $currentTime
        ]);
        return $stmt->fetch();
    }

    private function getDurationAverage(int $consultant_id): ?array
    {
        $sql = "SELECT ROUND(SUM(duration) / COUNT(*)) as average FROM clients WHERE served = 1 AND consultant_id = :consultant_id";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([
            'consultant_id' => $consultant_id,
        ]);
        return $data = $stmt->fetch();
    }

    public function getAllClients(string $currentTime, int $dataLimit = 5): ?array
    {
        $data = [];
        $loginKeys = $this->getAllClientsLoginKeys($dataLimit);
        foreach ($loginKeys as $loginKey) {
            $client = $this->getClient($loginKey['login_key'], $currentTime);
            $data[] = $client;
        }
        return $data;
    }

    private function getAllClientsLoginKeys(int $dataLimit): ?array
    {
        $sql = "SELECT login_key FROM clients WHERE served = 0 ORDER BY created_at LIMIT $dataLimit";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([
            'dataLimit' => $dataLimit
        ]);
        $data = $stmt->fetchAll();
        return $data;
    }

    public function getSecondClient(int $id): ?array
    {
        $client = $this->getClientConsultantIdAndDate($id);
        $lastClientDate = $this->getLastClientDate($client['consultant_id']);

        if ($client['created_at'] != $lastClientDate) {
            $sql = "SELECT id, created_at FROM clients WHERE created_at > :createdAt AND consultant_id = :consultantId LIMIT 1";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute([
                'createdAt' => $client['created_at'],
                'consultantId' => $client['consultant_id']
            ]);
            $data = $stmt->fetch();

            return $data;
        }
        return null;
    }

    private function getClientConsultantIdAndDate(int $id): ?array
    {
        $sql = "SELECT consultant_id, created_at FROM clients WHERE id = :id";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);
        $data = $stmt->fetch();
        return $data;
    }

    private function getLastClientDate(int $consultantId): ?string
    {
        $sql = "SELECT created_at FROM clients WHERE consultant_id = :consultantId AND served = 0 ORDER BY created_at DESC LIMIT 1";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([
            'consultantId' => $consultantId
        ]);
        $data = $stmt->fetch();
        return $data['created_at'];
    }

    public function getStatistic(): ?array
    {
        $sql = "SELECT DATE(created_at), HOUR(created_at), COUNT(id) FROM clients GROUP BY date_format(created_at, '%Y%m%d%H' ) ORDER BY DATE(created_at) DESC, HOUR(created_at)";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function getStatisticByConsultantId(int $consultantId): ?array
    {
        $sql = "SELECT DATE(created_at), HOUR(created_at), COUNT(id), id FROM clients WHERE consultant_id = :consultantId GROUP BY date_format(created_at, '%Y%m%d%H' ) ORDER BY DATE(created_at) DESC, HOUR(created_at)";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([
            'consultantId' => $consultantId
        ]);
        $data = $stmt->fetchAll();

        return $data;
    }

    public function served(int $id): void
    {
        $sql = "UPDATE clients SET served = :served WHERE id = :id";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'served' => 1
        ]);
        $this->setDuration($id);
    }

    private function setDuration(int $id): void
    {
        $sql = "UPDATE clients SET duration = TIME_TO_SEC(TIMEDIFF(updated_at, created_at)) WHERE id = :id";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);
    }

    public function setLaterDate(int $id, string $date): void
    {
        $sql = "UPDATE clients SET created_at = :date WHERE id = :id";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'date' => $date
        ]);
    }

    public function delete(int $id): void
    {
        $sql = 'DELETE FROM clients WHERE id = ?';
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([$id]);
    }

}

?>
