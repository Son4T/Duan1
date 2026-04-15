<?php
class AdminCategoryController {
    public function index(){
        $categories = (new Category)->all();
        $message = session_flash('message');
        return view('Admin.categories.list', compact('categories','message'));
    }

    public function create(){
        return view('Admin.categories.add');
    }

    public function storage(){
        if (isset($_POST['sbm_add_cate'])) {
            // Lấy toàn bộ dữ liệu từ $_POST
            $data = $_POST; 
    
            // Kiểm tra xem dữ liệu có đầy đủ không (có thể bỏ qua nếu không muốn kiểm tra chi tiết)
            if (empty($data['add_category']) || empty($data['category_type'])) {
                $_SESSION['message'] = "Vui lòng điền đầy đủ thông tin!";
                header("Location: index.php?role=admin&act=AddCategory");
                exit();
            }
    
            // Chuyển đổi các tên trường của mảng $data cho phù hợp với tên cột trong cơ sở dữ liệu
            $categoryData = [
                'cate_name' => $data['add_category'],
                'type' => $data['category_type']
            ];
    
            // Gọi hàm create từ model Category để lưu danh mục vào cơ sở dữ liệu
            $category = new Category();
            $category->create($categoryData);
            
            $_SESSION['message'] = "thêm dữ liệu thành công";

            // Redirect về trang danh sách danh mục
            header("Location: index.php?role=admin&act=Category");
            exit();
        }
    }

    public function edit(){
        $id = $_GET['id'];
        $category = (new Category)->find($id);
        $message = session_flash('message');
        return view('Admin.categories.update', compact('category', 'message'));
    }

    public function update() {
        if (isset($_POST['id']) && isset($_POST['update_category']) && isset($_POST['update_category_type'])) {
            $categoryId = $_POST['id'];
            $data = [
                'cate_name' => $_POST['update_category'],
                'type' => $_POST['update_category_type']
            ];
    
            try {
                // Gọi phương thức update với ID và mảng dữ liệu
                (new Category)->update($categoryId, $data);
    
                // Cập nhật thông báo thành công
                $_SESSION['message'] = "Cập nhật dữ liệu thành công";
            } catch (Exception $e) {
                // Xử lý khi xảy ra lỗi
                $_SESSION['message'] = $e->getMessage();
            }
    
            // Chuyển hướng lại trang chỉnh sửa
            header("Location: index.php?role=admin&act=Edit&id=" . $categoryId);
            exit;
        } else {
            // Nếu không có dữ liệu hợp lệ
            $_SESSION['message'] = "Dữ liệu không hợp lệ";
            header("Location: index.php?role=admin&act=Edit&id=" . $_POST['id']);
            exit;
        }
    }
    

    public function deleteCategory($id) {
        // Kiểm tra nếu ID hợp lệ và tồn tại
        if (isset($id) && is_numeric($id)) {
            // Khởi tạo đối tượng Category và thực hiện xóa
            $category = new Category();
            $category->delete($id);  // Gọi phương thức delete của class Category để xóa danh mục theo ID
    
            // Lưu thông báo vào session
            $_SESSION['message'] = "Xóa dữ liệu thành công";
    
            // Chuyển hướng người dùng về trang danh mục sau khi xóa
            header('Location: index.php?role=admin&act=Category'); 
            exit();
        } else {
            // Nếu không có ID hoặc ID không hợp lệ
            $_SESSION['message'] = "Không thể xóa. ID không hợp lệ.";
            
            // Chuyển hướng người dùng về trang danh mục nếu xảy ra lỗi
            header('Location: index.php?role=admin&act=Category'); 
            exit();
        }
    }
    
}