<?php

namespace App\model;

use Exception;
use PDO;
use App\entity\User;
use App\core\Model;

class UserModel extends Model
{
    protected $table = 'user';

    /**
     * Summary of findByEmail
     * @param string $email
     * @return User | null
     * @throws Exception
     */
    public function findByEmail(string $email): ?User
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE email = :email";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['email' => $email]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\\entity\\User');
            $user = $stmt->fetch();
            return $user ?: null;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Summary of save User in database
     * @param array $data
     * @return User
     * @throws Exception
     */
    public function save(array $data): User
    {
        try {
            $query = "INSERT INTO {$this->table} (firstname, lastname, email, role, password) VALUES (:firstname, :lastname, :email, :role, :password)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'role' => $data['role'],
                'password' => $data['password'],
            ]);
            $id = (int)$this->pdo->lastInsertId();
            return $this->find($id);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Summary of find
     * @param int $id
     * @return User
     * @throws Exception
     */
    public function find(int $id): User
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['id' => $id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\\entity\\User');
            $user = $stmt->fetch();
            if (!$user) {
                throw new Exception('User not found.');
            }
            return $user;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * get all users
     * @return array
     * @throws Exception
     */
    public function findAll(): array
    {
        try {
            $query = "SELECT * FROM {$this->table}";
            $stmt = $this->pdo->query($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\\entity\\User');
            return $stmt->fetchAll() ?: [];
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * update a user
     * @param array $data
     * @return boolean
     * @throws Exception
     */
    public function update(array $data): bool
    {
        try {
            // Séparer l'ID du reste
            $id = $data['id'] ?? null;
            if (!$id) {
                throw new Exception("Missing iduser for update");
            }

            // On retire l'iduser de la liste des colonnes à mettre à jour
            $fields = array_filter(
                $data,
                fn($key) => $key !== 'id',
                ARRAY_FILTER_USE_KEY
            );

            // Construction dynamique du SET
            $set = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($fields)));

            $query = "UPDATE {$this->table} SET $set WHERE id = :id";

            $stmt = $this->pdo->prepare($query);

            // Fusion data SET + iduser
            $fields['id'] = $id;

            return $stmt->execute($fields);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * delete a user
     * @param int $id
     * @return boolean
     * @throws Exception
     */
    public function delete(int $id): bool
    {
        try {
            $query = "DELETE FROM {$this->table} WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute(['iduser' => $id]);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
