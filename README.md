# Đồ án PHP - MySQL: Website bán áo
Hoàng Quốc An - Nguyễn Công Triệu

## Cấu trúc tổng quát
1. config                  => Chứa các file config chung cho toàn bộ page
    + db.php                  -> File config của database
    + img.php                 -> File config đường dẫn ảnh

2. manager/                   => Chứa các trang quản lý của admin
    + templates/              => Chứa các thành phần giao diện chung trên các trang của admin
        - css/
        - ...

    + admins/              => Chứa các trang thuộc nhóm quản trị admin
    + main/                => Chứa các trang thuộc nhóm quản trị chính (bao gồm trang admin chính)
    + questions/           => Chứa các trang thuộc nhóm quản trị các câu hỏi mà người dùng thường thắc mắc
    + customers/           => Chứa các trang thuộc nhóm quản trị khách hàng
    + items/               => Chứa các trang thuộc nhóm quản trị sản phẩm
    + ...

3. public/                  => Chứa các trang hiện thị public cho người dùng
    + templates/              => Chứa các thành phần giao diện chung trên các trang public
        - css/
    
    + img/                 => Nơi chứa ảnh public

    + ...

## Cấu trúc dạng cây
├── cache
│  ├── backup.txt
│  ├── bigprojectone.sql
│  ├── db_backup.txt
│  ├── homepage.png
│  └── homepage.xml
├── config
│  ├── db.php
│  └── img.php
├── manager
│  ├── admins
│  │  ├── admin-delete-process.php
│  │  ├── admin-insert-process.php
│  │  ├── admin-insert.php
│  │  ├── admin-notification.php
│  │  ├── admin-update-process.php
│  │  ├── admin-update.php
│  │  └── admins-manager.php
│  ├── customers
│  │  ├── customer-delete-process.php
│  │  ├── customer-insert-process.php
│  │  ├── customer-insert.php
│  │  ├── customer-notification.php
│  │  ├── customer-update-process.php
│  │  ├── customer-update.php
│  │  └── customers-manager.php
│  ├── items
│  │  ├── item-delete-process.php
│  │  ├── item-insert-process.php
│  │  ├── item-insert.php
│  │  ├── item-notification.php
│  │  ├── item-update-process.php
│  │  ├── item-update.php
│  │  └── items-manager.php
│  ├── main
│  │  ├── css
│  │  │  ├── sign-in-process-style.css
│  │  │  └── sign-in-style.css
│  │  ├── forget-account.php
│  │  ├── js
│  │  │  └── sign-in-action.js
│  │  ├── main-manager.php
│  │  ├── sign-in-process.php
│  │  ├── sign-in.php
│  │  └── sign-out.php
│  ├── orders
│  │  ├── order-accept-process.php
│  │  ├── order-cancel-process.php
│  │  └── orders-manager.php
│  ├── questions
│  │  ├── question-delete-process.php
│  │  ├── question-insert-process.php
│  │  ├── question-insert.php
│  │  ├── question-notification.php
│  │  ├── question-update-process.php
│  │  ├── question-update.php
│  │  └── questions-manager.php
│  └── templates
│     ├── check-admin-signed-in.php
│     ├── css
│     │  ├── all.css
│     │  ├── header-style.css
│     │  ├── layout.css
│     │  └── menu-style.css
│     ├── header.php
│     ├── js
│     │  └── menu-action.js
│     └── menu.php
├── public
│  ├── contact.php
│  ├── display-cart.php
│  ├── display-item-details.php
│  ├── display-orders-details.php
│  ├── display-orders.php
│  ├── home.php
│  ├── img
│  │  ├── admins
│  │  ├── background
│  │  │  ├── bg1.png
│  │  │  └── bg2.png
│  │  ├── counselors
│  │  │  ├── counselor_1.png
│  │  │  └── tu_van.jpg
│  │  ├── customers
│  │  ├── items
│  │  │  ├── 7b5c39d3479f582a78ae65b6a6267a80.png
│  │  │  ├── 44c6b8b2d94caf6a09a566a4af3984e3.png
│  │  │  ├── a9d41159a35e0240e6422466d2f472b8.png
│  │  │  ├── c8e55bd75f9e1a44a0bd6129af2292db.png
│  │  │  ├── d7b65f4e24d3f14c9591765e420410a0.png
│  │  │  ├── daddc749b8c8161a704d3afbe8c207df.png
│  │  │  ├── e8ecd36dfaafea069b903bcf7ecfa918.png
│  │  │  ├── e476c3c7f8539966de14b8c871a69328.png
│  │  │  ├── e48427cc533da56efdebbe19e6af3e09.png
│  │  │  ├── eab2dd953f537b3434ec1f6b6d14cac1.png
│  │  │  ├── f2c4e6a6d92fd7cb1f9845909c17c283.jpeg
│  │  │  ├── f3b391fdce28c6768f4919d69d221a6e.png
│  │  │  ├── f25cc4e39700dc633113ea005d7e56bf.png
│  │  │  ├── f79d08962917668bd8ed5f9e120201eb.png
│  │  │  ├── rong_chuyen_hoa.jpg
│  │  │  └── shirt.jpg
│  │  ├── others
│  │  │  ├── account_circle-white-36dp.svg
│  │  │  ├── add-black-24dp.svg
│  │  │  ├── add-white-36dp.svg
│  │  │  ├── add_box-black-24dp.svg
│  │  │  ├── admin_panel_settings-white-36dp.svg
│  │  │  ├── arrow_back_ios-24px.svg
│  │  │  ├── arrow_forward_ios-24px.svg
│  │  │  ├── baseline_account_circle_black_18dp.png
│  │  │  ├── baseline_shopping_cart_black_18dp.png
│  │  │  ├── cancel-black-24dp.svg
│  │  │  ├── cancel-black-36dp.svg
│  │  │  ├── cart-empty.svg
│  │  │  ├── clear-black-24dp.svg
│  │  │  ├── clear-white-24dp.svg
│  │  │  ├── clear-white-36dp.svg
│  │  │  ├── create-white-36dp.svg
│  │  │  ├── delete-white-36dp.svg
│  │  │  ├── delete_forever-black-24dp.svg
│  │  │  ├── delete_forever-black-36dp.svg
│  │  │  ├── east-24px.svg
│  │  │  ├── empty-cart.png
│  │  │  ├── home-black-36dp.svg
│  │  │  ├── home-white-24dp.svg
│  │  │  ├── home-white-36dp.svg
│  │  │  ├── keyboard_arrow_up-black-24dp.svg
│  │  │  ├── keyboard_arrow_up-white-24dp.svg
│  │  │  ├── menu-black-24dp.svg
│  │  │  ├── more_horiz-black-24dp.svg
│  │  │  ├── person_remove-white-36dp.svg
│  │  │  ├── remove-black-24dp.svg
│  │  │  ├── search-black-24dp.svg
│  │  │  ├── shopping_cart-24px.svg
│  │  │  ├── shopping_cart-white-36dp.svg
│  │  │  └── shopping_cart-white-48dp.svg
│  │  └── socials
│  │     ├── account_circle-white-18dp.svg
│  │     ├── account_circle-white-24dp.svg
│  │     ├── email-white-36dp.svg
│  │     ├── facebook-black-18dp.svg
│  │     ├── facebook-icon.png
│  │     ├── facebook-logo.png
│  │     ├── facebook-white-36dp.svg
│  │     ├── google-icon.png
│  │     ├── logo.png
│  │     ├── logo_1.png
│  │     ├── person-white-24dp.svg
│  │     ├── person-white-36dp.svg
│  │     ├── rk.png
│  │     ├── search-24px.svg
│  │     ├── search-white-18dp.svg
│  │     ├── shopping_cart-white-18dp.svg
│  │     ├── supervisor_account-white-24dp.svg
│  │     ├── zalo-icon.png
│  │     └── Zalo-logo.png
│  ├── qna.php
│  ├── sign-up-process.php
│  ├── sign-up.php
│  └── templates
│     ├── account
│     │  ├── account-options.php
│     │  ├── check-customer-signed-in.php
│     │  ├── sign-in-process.php
│     │  ├── sign-in.php
│     │  └── sign-out-process.php
│     ├── cart
│     │  ├── add-item-to-cart.php
│     │  ├── cart-item.php
│     │  ├── delete-all-cart.php
│     │  ├── delete-item-from-cart.php
│     │  └── display-items.php
│     ├── css
│     │  └── all.css
│     ├── item
│     │  ├── change-item-amount.php
│     │  └── item.php
│     ├── order
│     │  ├── get-info-before-order.php
│     │  ├── order-detail-item.php
│     │  ├── order-item.php
│     │  └── process-order.php
│     └── ui
│        ├── background.php
│        ├── footer.php
│        ├── header.php
│        ├── menu.php
│        └── slide-menu.php
├── README.md
└── todos.wiki