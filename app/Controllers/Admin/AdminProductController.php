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
                $productType = isset($data['type']) ? $data['type'] : '';
                header("location: index.php?role=admin&act=AddProduct&product_type=" . urlencode($productType));
                exit();
                return;
            }

            // Xử lý file hình ảnh sản phẩm
            $image = null;
            
            // Kiểm tra xem có file được upload không
            if (!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
                $_SESSION['message'] = "Vui lòng chọn ảnh sản phẩm!";
                $productType = isset($data['type']) ? $data['type'] : '';
                header("location: index.php?role=admin&act=AddProduct&product_type=" . urlencode($productType));
                exit();
                return;
            }
            
            // Kiểm tra lỗi upload
            if ($_FILES['image']['error'] != UPLOAD_ERR_OK) {
                $_SESSION['message'] = "Lỗi tải ảnh lên: " . $this->getUploadErrorMessage($_FILES['image']['error']);
                $productType = isset($data['type']) ? $data['type'] : '';
                header("location: index.php?role=admin&act=AddProduct&product_type=" . urlencode($productType));
                exit();
                return;
            }
            
            // Upload ảnh
            $image = $this->uploadImage($_FILES['image']);
            if (!$image) {
                $_SESSION['message'] = "Lỗi trong việc tải ảnh lên. Vui lòng thử lại!";
                $productType = isset($data['type']) ? $data['type'] : '';
                header("location: index.php?role=admin&act=AddProduct&product_type=" . urlencode($productType));
                exit();
                return;
            }

            // Thêm sản phẩm vào cơ sở dữ liệu
            $product = new Product();
            $data['image'] = $image; // Thêm đường dẫn ảnh vào mảng dữ liệu
            
            try {
                $result = $product->create($data);
                
                // Kiểm tra kết quả thêm sản phẩm
                if ($result) {
                    $_SESSION['message'] = "Sản phẩm đã được thêm thành công!";
                    header("location: index.php?role=admin&act=Product");
                    exit();
                } else {
                    $_SESSION['message'] = "Có lỗi xảy ra trong quá trình thêm sản phẩm!";
                    // Xóa ảnh vừa upload nếu thêm sản phẩm thất bại
                    if (!empty($image) && file_exists($image)) {
                        unlink($image);
                    }
                    $productType = isset($data['type']) ? $data['type'] : '';
                    header("location: index.php?role=admin&act=AddProduct&product_type=" . urlencode($productType));
                    exit();
                }
            } catch (Exception $e) {
                $_SESSION['message'] = "Lỗi: " . $e->getMessage();
                // Xóa ảnh vừa upload nếu có lỗi
                if (!empty($image) && file_exists($image)) {
                    unlink($image);
                }
                $productType = isset($data['type']) ? $data['type'] : '';
                header("location: index.php?role=admin&act=AddProduct&product_type=" . urlencode($productType));
                exit();
            }
        }
    }
    
    // Hàm lấy message lỗi upload
    private function getUploadErrorMessage($errorCode)
    {
        $errors = [
            UPLOAD_ERR_INI_SIZE => "Ảnh vượt quá kích thước tối đa được phép cấu hình trên server",
            UPLOAD_ERR_FORM_SIZE => "Ảnh vượt quá kích thước tối đa được xác định trong form",
            UPLOAD_ERR_PARTIAL => "Ảnh chỉ được tải lên một phần",
            UPLOAD_ERR_NO_FILE => "Không có ảnh được chọn",
            UPLOAD_ERR_NO_TMP_DIR => "Không có thư mục tạm thời",
            UPLOAD_ERR_CANT_WRITE => "Không thể ghi ảnh vào đĩa",
            UPLOAD_ERR_EXTENSION => "Phần mở rộng file bị cấm"
        ];
        return isset($errors[$errorCode]) ? $errors[$errorCode] : "Lỗi không xác định";
    }

    // Hàm xử lý upload ảnh sản phẩm
    private function uploadImage($file)
    {
        // Validate: Kiểm tra file tồn tại
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            return null;
        }

        // Định nghĩa thư mục lưu ảnh
        $uploadDir = 'Assets/Admin/Uploads/';

        // Kiểm tra nếu thư mục không tồn tại, tạo mới
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);  // 0755 thay vì 0777 (an toàn hơn)
        }

        // Lấy thông tin về file tải lên
        $fileName = basename($file['name']);
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        // Validate: Kiểm tra tên file không rỗng
        if (empty($fileName)) {
            return null;
        }

        // Xác định loại file
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validate: Kiểm tra extension hợp lệ
        if (!in_array($fileExt, $allowedExtensions)) {
            return null;
        }

        // Validate: Kiểm tra lỗi tải file
        if ($fileError !== UPLOAD_ERR_OK) {
            return null;
        }

        // Validate: Kiểm tra kích thước file (5MB max)
        $maxSize = 5 * 1024 * 1024;  // 5MB
        if ($fileSize > $maxSize || $fileSize <= 0) {
            return null;
        }

        // Validate: Kiểm tra MIME type thực tế (không chỉ dựa vào $_FILES['type'])
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $fileTmpName);
        finfo_close($finfo);

        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($mimeType, $allowedMimeTypes)) {
            return null;
        }

        // Validate: Kiểm tra file có phải image thực sự không
        $imageInfo = @getimagesize($fileTmpName);
        if ($imageInfo === false) {
            return null;  // File không phải là image hợp lệ
        }

        // Tạo tên mới cho ảnh để tránh trùng lặp và các cuộc tấn công
        $newFileName = time() . '_' . uniqid() . '.' . $fileExt;
        $uploadFilePath = $uploadDir . $newFileName;

        // Di chuyển file từ thư mục tạm vào thư mục lưu trữ
        if (@move_uploaded_file($fileTmpName, $uploadFilePath)) {
            return $uploadFilePath;
        }

        return null;
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
    
    // Kiểm tra xem có đơn hàng đang hoạt động không
    $productModel = new Product();
    $hasActiveOrders = $productModel->hasActiveOrders($id);
    $totalOrders = $productModel->getTotalOrdersWithProduct($id);
    
    $message = session_flash('message');
    return view('Admin.products.delete', compact('product', 'message', 'hasActiveOrders', 'totalOrders'));
}

public function deleteProductAction($id)
{
    // Validate: Kiểm tra phương thức POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $_SESSION['message'] = "Yêu cầu không hợp lệ.";
        header("location: index.php?role=admin&act=Product");
        exit;
    }
    
    // Validate: Kiểm tra ID có trống hay không
    if (empty($id)) {
        $_SESSION['message'] = "ID sản phẩm không hợp lệ.";
        header("location: index.php?role=admin&act=Product");
        exit;
    }
    
    // Validate: Kiểm tra ID có phải số nguyên dương không
    if (!is_numeric($id) || intval($id) <= 0) {
        $_SESSION['message'] = "ID sản phẩm không hợp lệ.";
        header("location: index.php?role=admin&act=Product");
        exit;
    }
    
    // Validate: Kiểm tra sản phẩm có tồn tại không
    $product = (new Product)->find($id);
    if (!$product) {
        $_SESSION['message'] = "Không tìm thấy sản phẩm.";
        header("location: index.php?role=admin&act=Product");
        exit;
    }
    
    // Kiểm tra xem sản phẩm có trong đơn hàng đang hoạt động không
    try {
        $productModel = new Product();
        if ($productModel->hasActiveOrders($id)) {
            $_SESSION['message'] = "Không thể xóa sản phẩm vì có đơn hàng đang hoạt động (pending/processing/confirmed). Vui lòng hủy hoặc hoàn thành các đơn hàng trước.";;
            header("location: index.php?role=admin&act=Product");
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        header("location: index.php?role=admin&act=Product");
        exit;
    }
    
    // Xóa ảnh cũ nếu tồn tại
    if (!empty($product['image']) && file_exists($product['image'])) {
        if (!unlink($product['image'])) {
            error_log("Không thể xóa ảnh: " . $product['image']);
        }
    }
    
    // Thực hiện xóa sản phẩm
    try {
        $deleted = (new Product)->delete($id);
        if ($deleted) {
            $_SESSION['message'] = "Xóa sản phẩm thành công.";
        } else {
            $_SESSION['message'] = "Có lỗi xảy ra khi xóa sản phẩm.";
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
    }
    
    header("location: index.php?role=admin&act=Product");
    exit;
}
}
