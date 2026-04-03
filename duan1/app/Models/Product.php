<?php
class Product
{
    public $pdo; // Đối tượng PDO để tương tác với cơ sở dữ liệu

    // Hàm khởi tạo: Kết nối cơ sở dữ liệu
    public function __construct()
    {
        $db = new Database(); // Giả sử có lớp Database để lấy kết nối
        $this->pdo = $db->getConnection(); // Lấy đối tượng PDO
    }

    // Lấy tất cả sản phẩm cùng với tên danh mục
    public function all()
    {
        $sql = "SELECT p.*, c.cate_name 
                FROM products p 
                JOIN categories c ON p.category_id = c.id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách sản phẩm thuộc một danh mục cụ thể
    public function ProductInCategory($id)
    {
        $sql = "SELECT p.*, c.cate_name 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                WHERE c.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO products 
                    (name, image, price, description, content, type, category_id) 
                VALUES 
                    (:name, :image, :price, :description, :content, :type, :category_id)";
        $stmt = $this->pdo->prepare($sql);

        $executeData = [
            ':name' => $data['name'],
            ':image' => $data['image'],
            ':price' => $data['price'],
            ':description' => $data['description'],
            ':content' => $data['content'],
            ':type' => $data['type'],
            ':category_id' => $data['id_cate']
        ];

        return $stmt->execute($executeData);
    }

    // Tìm một sản phẩm theo ID
    public function find($id)
    {
        $sql = "SELECT p.*, c.cate_name 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                WHERE p.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật thông tin sản phẩm
    public function update($id, $data)
    {
        if (!isset($data['name'], $data['image'], $data['price'], $data['description'], $data['content'], $data['type'], $data['status'], $data['category_id'])) {
            throw new Exception("Thiếu thông tin cần thiết để cập nhật.");
        }

        $sql = "UPDATE products 
            SET name = :name, 
                image = :image, 
                price = :price, 
                description = :description, 
                content = :content, 
                type = :type, 
                status = :status, 
                category_id = :category_id 
            WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':image', $data['image']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':type', $data['type']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    // Xóa một sản phẩm theo ID
    public function delete($id)
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // Tăng số lượt xem
    public function incrementView($id)
    {
        $sql = "UPDATE products SET views = views + 1 WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function topSell()
    {
        $sql = "SELECT * FROM products ORDER BY view DESC LIMIT 4";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateView($id)
    {
        try {
            $sql = "UPDATE products SET view = view + 1 WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Error updating product view: " . $e->getMessage());
            return false;
        }
    }

    public function getBestSellingProducts()
    {
        $sql = "SELECT p.id, p.name, p.price, p.image, SUM(od.quantity) AS total_sold 
                FROM products p 
                JOIN order_details od ON p.id = od.product_id 
                GROUP BY p.id, p.name, p.price, p.image 
                ORDER BY total_sold DESC 
                LIMIT 10";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy sản phẩm kèm tên danh mục (chuẩn OOP)
    public function getProductByIdWithCate($id)
    {
        $sql = "SELECT p.*, c.cate_name 
                FROM products p
                JOIN categories c ON p.category_id = c.id
                WHERE p.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Xóa sản phẩm theo ID (chuẩn OOP)
    public function deleteProductById($id)
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
