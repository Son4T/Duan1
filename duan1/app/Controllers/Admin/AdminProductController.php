<?php
class AdminProductController
{
   public function index()
{
    $products = (new Product)->all();
    $message = session_flash('message'); // lấy thông báo từ session
    return view('Admin.products.list', compact('products', 'message'));
}


    public function createT()
    {
        return view('Admin.products.type');
    }
    public function updateForm()
    {
        $id = $_GET['id'];
        $product = (new Product)->find($id);
        $categories = (new Category)->all();
        $category = (new Category)->find($product['category_id']);
        $message = session_flash('message');
        return view('Admin.products.update', compact('product', 'category', 'categories', 'message'));
    }
    public function createP()
    {
        $categories = (new Category)->all();
        $message = session_flash('message');
        return view('Admin.products.add', compact('categories', 'message'));
    }
    // Hàm xử lý thêm sản phẩm
    public function storage()
    {
        // Kiểm tra xem form có được submit không
        if (isset($_POST['sbm_add_product'])) {
            // Lấy tất cả dữ liệu từ $_POST
            $data = $_POST;

            // Kiểm tra nếu các trường bắt buộc không có giá trị hợp lệ, trả về lỗi
            if (empty($data['id_cate']) || empty($data['name']) || empty($data['price']) || empty($data['content']) || empty($data['description'])) {
                $_SESSION['message'] = "Vui lòng điền đầy đủ thông tin";
                header("location: index.php?role=admin&act=AddProduct");
                exit();
                return;
            }

            // Xử lý file hình ảnh sản phẩm
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image = $this->uploadImage($_FILES['image']);
                // Kiểm tra xem ảnh có được upload thành công không
                if (!$image) {
                    $_SESSION['message'] = "Lỗi trong việc tải ảnh lên. Vui lòng thử lại!";
                    header("location: index.php?role=admin&act=AddProduct");
                    exit();
                    return;
                }
            }

            // Thêm sản phẩm vào cơ sở dữ liệu
            $product = new Product();
            $data['image'] = $image; // Thêm đường dẫn ảnh vào mảng dữ liệu
            $result = $product->create($data);

            // Kiểm tra kết quả thêm sản phẩm
            if ($result) {
                $_SESSION['message'] = "Sản phẩm đã được thêm thành công!";
                header("location: index.php?role=admin&act=Product");
                exit();
            } else {
                $_SESSION['message'] = "Có lỗi xảy ra trong quá trình thêm sản phẩm!";
                header("location: index.php?role=admin&act=AddProduct");
                exit();
            }
        }
    }
    

    // Hàm xử lý upload ảnh sản phẩm
    private function uploadImage($file)
    {
        // Định nghĩa thư mục lưu ảnh
        $uploadDir = 'Assets/Admin/Uploads/';  // Đổi đường dẫn tới thư mục phù hợp với yêu cầu

        // Kiểm tra nếu thư mục không tồn tại, tạo mới
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);  // Tạo thư mục nếu không có
        }

        // Lấy thông tin về file tải lên
        $fileName = basename($file['name']);
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        // Xác định loại file
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Kiểm tra lỗi tải file
        if ($fileError !== 0) {
            return null;  // Nếu có lỗi, không xử lý và trả về null
        }

        // Kiểm tra loại file có hợp lệ không
        if (!in_array($fileType, $allowedTypes)) {
            return null;  // Nếu không phải là ảnh hợp lệ, trả về null
        }

        // Kiểm tra kích thước file (tùy chỉnh theo nhu cầu của bạn)
        if ($fileSize > 5000000) {  // 5MB
            return null;  // Nếu ảnh quá lớn, trả về null
        }

        // Tạo tên mới cho ảnh để tránh trùng lặp
        $newFileName = uniqid('', true) . '.' . $fileExt;  // Tạo ID duy nhất + phần mở rộng

        // Đường dẫn đầy đủ để lưu ảnh
        $uploadFilePath = $uploadDir . $newFileName;

        // Di chuyển file từ thư mục tạm vào thư mục lưu trữ
        if (move_uploaded_file($fileTmpName, $uploadFilePath)) {
            return $uploadFilePath;  // Trả về đường dẫn của ảnh đã lưu
        }

        return null;  // Nếu không thể di chuyển ảnh, trả về null
    }
    
    

    public function update($id)
    {
        if (isset($_POST['sbm_update_product'])) {
            // Lấy tất cả dữ liệu từ $_POST
            $data = $_POST;

            // Kiểm tra các trường bắt buộc
            if (empty($data['category_id']) || empty($data['name']) || empty($data['price']) || empty($data['description'])) {
                $_SESSION['message'] = "Vui lòng điền đầy đủ thông tin";
                header("location: index.php?role=admin&act=UpdateProductForm&id=" . $id);
                exit;
            }

            // Xử lý file hình ảnh sản phẩm
            $image = $data['old_img']; // Sử dụng ảnh cũ mặc định
            if (isset($_FILES['Uimg_src_product']) && $_FILES['Uimg_src_product']['error'] == 0) {
                $uploadedImage = $this->uploadImage($_FILES['Uimg_src_product']);
                if (!$uploadedImage) {
                    $_SESSION['message'] = "Lỗi trong việc tải ảnh lên. Vui lòng thử lại!";
                    header("location: index.php?role=admin&act=UpdateProductForm&id=" . $id);
                    exit;
                }
                $image = $uploadedImage; // Cập nhật ảnh mới
            }

            // Gán giá trị ảnh vào mảng dữ liệu
            $data['image'] = $image;

            // Cập nhật sản phẩm trong cơ sở dữ liệu
            $product = new Product();
            $result = $product->update($id, $data); // Đảm bảo phương thức update được gọi
            

            // Kiểm tra kết quả cập nhật
            if ($result) {
                $_SESSION['message'] = "Cập nhật sản phẩm thành công.";
                header("location: index.php?role=admin&act=Product");
            } else {
                $_SESSION['message'] = "Có lỗi xảy ra trong quá trình cập nhật sản phẩm.";
                header("location: index.php?role=admin&act=UpdateProductForm&id=" . $id);
                exit;  // Dừng mã tiếp theo
            }
        } else {
            // Nếu form chưa được submit
            header("location: index.php?role=admin&act=UpdateProductForm&id=" . $id);
            exit;  // Dừng mã tiếp theo
        }
        
    }
    
    // ====== HÀM XÓA SẢN PHẨM ======
    
public function confirmDeleteProduct($id)
{
    $product = (new Product)->find($id);
    if (!$product) {
        $_SESSION['message'] = "Không tìm thấy sản phẩm.";
        header("location: index.php?role=admin&act=Product");
        exit;
    }
    return view('Admin.products.delete', compact('product'));
}

public function deleteProductAction($id)
{
    $deleted = (new Product)->delete($id);
    if ($deleted) {
        $_SESSION['message'] = "Xóa sản phẩm thành công.";
    } else {
        $_SESSION['message'] = "Có lỗi xảy ra khi xóa sản phẩm.";
    }
    header("location: index.php?role=admin&act=Product");
    exit;
}



// ====== THÊM HÀM delete() để Web.php không báo lỗi ======
public function delete($id)
{
    return $this->deleteProductAction($id);
}
}
