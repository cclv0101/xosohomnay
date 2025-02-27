<?php 
define('EXPORT_EXCEL_DT',
    array( 
        array(
            array('tbl_article', 'Bài viết'),
            array('article_title', 'Tiêu đề bài viết'),
            array('article_slug', 'Đường dẫn'),
            array('article_desc', 'Mô tả bài viết'),
            array('article_total_view', 'Lượt xem'),
        ),
        array(
            array('tbl_user', 'Tài khoản'),
            array('user_username', 'Tài khoản'),
            array('user_fullname', 'Họ và tên'),
        ),
        array(
            array('tbl_project', 'Dự án'),
            array('project_title', 'Tiêu đề dự án'),
            array('project_slug', 'Đường dẫn'),
            array('project_desc', ' Mô tả dự án'),
            array('project_total_view', 'Lượt xem'),
        ),
        array(
            array('tbl_product', 'Sản phẩm'),
            array('product_name', 'Tên sản phẩm'),
            array('product_slug', 'Đường dẫn'),
            array('product_tags', 'Thẻ mô tả'),
            array('product_price', 'Giá sản phẩm'),
            array('product_sale', 'Đang giảm giá'),
            array('product_amount', 'Số lượng trong kho'),
            array('product_total_sale', 'Số lượng đã bán'),
            array('product_total_add_cart', 'Số lượt thêm vào giỏ'),
            array('product_total_view', 'Số lượt xem'),
            array('product_desc', 'Mô tả sản phẩm'),
        ),
        array(
            array('tbl_page', 'Trang'),
            array('page_title', 'Tiêu đề trang'),
            array('page_slug', 'Đường dẫn'),
            array('page_desc', 'Mô tả ngắn'),
            array('page_total_view', 'Lượt xem trang'),
        ),
        array(
            array('tbl_customer', 'Khách hàng'),
            array('customer_username', 'Định danh khách hàng'),
            array('customer_fullname', 'Họ tên khách hàng'),
            array('customer_address', 'Địa chỉ nhà khách hàng'),
            array('customer_phone', 'Số điện thoại khách hàng'),
            array('customer_email', 'E-mail khách hàng'),
            array('customer_ip', 'IP khách hàng'),
            array('customer_interests', 'Sở thích người dùng'),
            array('customer_total_order', 'Tổng đơn mua'),
            array('customer_total_satisfaction', 'Độ hài lòng sản phẩm/ dịch vụ (/100)'),
            array('customer_total_visit', 'Số lần truy cập'),
            array('customer_time_visit', 'Thời gian truy cập'),
        ),
        array(
            array('tbl_booking', 'Lịch hẹn'),
            array('booking_nickname', 'Định danh khách hàng'),
            array('booking_fullname', 'Họ tên khách hàng'),
            array('booking_phone', 'Số điện thoại khách hàng'),
            array('booking_email', 'E-mail khách hàng'),
            array('booking_ip', 'IP khách hàng'),
        ),
        array(
            array('tbl_order', 'Đơn hàng'),
            array('order_nickname', 'Định danh khách hàng'),
            array('order_fullname', 'Họ tên khách hàng'),
            array('order_phone', 'Số điện thoại khách hàng'),
            array('order_email', 'E-mail khách hàng'),
            array('order_address', 'Địa chỉ nhận hàng'),
            array('order_ip', 'IP khách hàng'),
            array('order_code_express', 'Mã vận chuyển'),
            array('order_payments', 'Hình thức thanh toán'),
            array('order_stt_payment', 'Trạng thái đơn'),
            array('order_total_bill', 'Tổng tiền hóa đơn'),
            array('order_transport_free', 'Phí vận chuyển'),
            array('order_discount', 'Thực tiền giảm'),
            array('order_real_money_paid', 'Thực tiền trả'),
        ),
    ),
);
?>