<?php
class Category {
    public $pdo; // Biến lưu đối tượng PDO để làm việc với cơ sở dữ liệu

    // Hàm khởi tạo: Kết nối cơ sở dữ liệu thông qua lớp Database
    public function __construct(){
        $db = new Database(); // Tạo một đối tượng Database
        $this->pdo = $db->getConnection(); // Lấy kết nối PDO từ lớp Database
    }

    // Hàm `all`: Lấy tất cả các bản ghi từ bảng `categories`
    public function all(){
        $sql = "SELECT * FROM categories"; // Câu lệnh SQL để truy vấn tất cả các hàng
        $stmt = $this->pdo->prepare($sql); // Chuẩn bị câu lệnh SQL
        $stmt->execute(); // Thực thi câu lệnh
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách các hàng dưới dạng mảng kết hợp
    }

    // Hàm `create`: Thêm một danh mục mới vào bảng `categories`
    public function create($data){
        $sql = "INSERT INTO categories (cate_name, type) VALUES (:cate_name, :type)"; // Câu lệnh SQL thêm dữ liệu
        $stmt = $this->pdo->prepare($sql); // Chuẩn bị câu lệnh SQL
        $stmt->execute($data); // Thực thi câu lệnh với dữ liệu được truyền vào
    }

    // Hàm `update`: Cập nhật thông tin danh mục dựa trên `id`
    public function update($id, $data) {
        // Kiểm tra nếu ID và dữ liệu hợp lệ
        if (empty($id) || empty($data['cate_name']) || empty($data['type'])) {
            throw new Exception('Dữ liệu không hợp lệ');
        }
    
        // Câu lệnh SQL sử dụng placeholder
        $sql = "UPDATE categories SET cate_name = :cate_name, type = :type WHERE id = :id"; 
        
        // Chuẩn bị câu lệnh SQL
        $stmt = $this->pdo->prepare($sql);
    
        // Gán giá trị cho placeholder
        $stmt->bindParam(':cate_name', $data['cate_name']);
        $stmt->bindParam(':type', $data['type']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        // Thực thi câu lệnh
        $stmt->execute();
    }
    

    // Hàm `find`: Tìm và trả về một danh mục dựa trên `id`
    public function find($id){
        $sql = "SELECT * FROM categories WHERE id = :id"; // Câu lệnh SQL để tìm danh mục theo id
        $stmt = $this->pdo->prepare($sql); // Chuẩn bị câu lệnh SQL
        $stmt->execute(['id' => $id]); // Thực thi câu lệnh với `id` được truyền vào
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về một hàng dưới dạng mảng kết hợp
    }

    // Hàm `delete`: Xóa một danh mục dựa trên `id`
    public function delete($id){
        $sql = "DELETE FROM categories WHERE id = :id"; // Câu lệnh SQL xóa danh mục theo id
        $stmt = $this->pdo->prepare($sql); // Chuẩn bị câu lệnh SQL
        $stmt->execute(['id' => $id]); // Thực thi câu lệnh với `id` được truyền vào
    }
}
?>
