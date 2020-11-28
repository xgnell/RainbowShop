# Đồ án PHP - MySQL: Website bán áo
Hoàng Quốc An - Nguyễn Công Triệu

## Cấu trúc thư mục đồ án
config/                  => Chứa các file config chung cho toàn bộ page
    db.php                  -> File config của database

manager/                   => Chứa các trang quản lý của admin
    templates/              => Chứa các thành phần giao diện chung trên các trang của admin
        css/
        ...

    admins/              => Chứa các trang thuộc nhóm quản trị admin
    main/                => Chứa các trang thuộc nhóm quản trị chính (bao gồm trang admin chính)
    questions/           => Chứa các trang thuộc nhóm quản trị các câu hỏi mà người dùng thường thắc mắc
    customers/           => Chứa các trang thuộc nhóm quản trị khách hàng
    ...

public/                  => Chứa các trang hiện thị public cho người dùng
    templates/              => Chứa các thành phần giao diện chung trên các trang public
        css/
    
    img/                 => Nơi chứa ảnh public

    ...