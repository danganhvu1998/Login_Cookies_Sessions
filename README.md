# Login_Cookies_Sessions
Khởi tạo database ở file server/createDatabaseTable , thay tên đăng nhập và mk vào $username và $password

Tất cả các file đều là .php. Nhưng những file ở phần client đều chỉ có javascript và html, hoàn toàn không có php. Trừ cái testing.php, em muốn kiểm tra chút về COOKIE và SESSION. Dù sao thì nó cũng chẳng có tác dụng gì cả

Em có nhầm giữa sessions và seasons, lúc đầu em tưởng nó là 1 nên đặt tên trong bảng sai

Hình như có phải là những status server trả về có định dạng kiểu số 200, 400, 404, 403 gì gì đó, nhưng mà tạm thời em cứ để là dạng text khá sida nhưng mà tại lúc debug cần nên em cũng lười đổi

Em không chắc lắm việc đặt và xoá $_COOKIE và $_SESSION đều nằm ở server là đúng hay sai, tại vì đây là chạy trên máy nên có thể nó vẫn đúng nhưng nếu khi tách thành server là client riêng thì có thể không chạy nữa. Em đoán nếu thế thì phải gửi dữ liệu về client về giá trị COOKIE và SESSION về cho client rồi lưu ntn nó. Khi check sẽ đọc lại và kiểm tra. Nhưng đại khái khi nghĩ ra vấn đề này thì em lười quá nên hiện cứ thế đã. Bản chất nó cũng không sai khác lắm.

Anh thông cảm, em sắp kiểm tra N môn, có philo
