<div class="wrap">
	<h2>Cài Đặt Nút Liên Lạc</h2>
    <hr>
	<form action="options.php" method="post" id="nuu-contact-form" enctype="multipart/form-data">
        <?php echo settings_fields('nuu-contact-setting-options');?>
        <?php echo do_settings_sections($this->_menuSlug);?>
        <p class="submit">
			<input type="submit" name="submit" value="Lưu thay đổi"  class="button button-primary" >
		</p>
    </form>
	<p style='text-align:right; text-'><i>Để gửi mọi hỗ trợ, phản hồi, báo cáo lỗi hoặc yêu cầu tính năng, quý khách vui lòng truy cập <a href="http://nuu.edu.vn/lien-he/" target="_blank">liên kết này</a>.</i></p>
</div>

