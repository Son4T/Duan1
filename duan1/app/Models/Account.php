<?php
class Account
{
    private $pdo; // Đối tượng PDO

    public function __construct()
    {
        $db = new Database(); 
        $this->pdo = $db->getConnection();
    }

    // Lấy tất cả user
    public function all()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Kiểm tra email có tồn tại
    public function checkEmailExist($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm user mới
    public function insert($data)
    {
        $sql = "INSERT INTO users (fullname, email, password, phone, role, address, status, created_at, updated_at) 
                VALUES (:fullname, :email, :password, :phone, :role, :address, :status, :created_at, :updated_at)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'fullname'   => $data['fullname'],
            'email'      => $data['email'],
            'password'   => password_hash($data['password'], PASSWORD_DEFAULT), // hash mật khẩu
            'phone'      => $data['phone'],
            'role'       => $data['role'],
            'address'    => $data['address'] ?? '',
            'status'     => $data['status'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at']
        ]);
    }

    // Tìm user theo ID
    public function find($id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Xóa user theo ID
    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // Cập nhật user
    public function update($id, $data)
    {
        // Nếu không đổi mật khẩu thì bỏ qua
        if (empty($data['password'])) {
            $sql = "UPDATE users SET 
                        email = :email, 
                        fullname = :fullname, 
                        phone = :phone, 
                        role = :role,
                        address = :address, 
                        status = :status 
                    WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                'email'    => $data['email'],
                'fullname' => $data['fullname'],
                'phone'    => $data['phone'],
                'role'     => $data['role'],
                'address'  => $data['address'] ?? '',
                'status'   => $data['status'],
                'id'       => $id
            ]);
        } else {
            $sql = "UPDATE users SET 
                        email = :email, 
                        fullname = :fullname, 
                        phone = :phone, 
                        role = :role,
                        address = :address, 
                        status = :status,
                        password = :password 
                    WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                'email'    => $data['email'],
                'fullname' => $data['fullname'],
                'phone'    => $data['phone'],
                'role'     => $data['role'],
                'address'  => $data['address'] ?? '',
                'status'   => $data['status'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'id'       => $id
            ]);
        }
    }

    // Lấy user theo email
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // Đăng nhập
    public function login($email, $password)
    {
        $user = $this->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user; // đúng mật khẩu
        }
        return null; // sai
    }

    // Lấy user theo tên
    public function getUserByName($name)
    {
        $sql = "SELECT * FROM users WHERE fullname = :name LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['name' => $name]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
