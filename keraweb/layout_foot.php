		</div>
		<!-- /row -->

	</div>
	<!-- /container -->

<!-- jQuery library -->
<script src="libs/js/jquery.js"></script>

<!-- bootstrap JavaScript -->
<script src="libs/css/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="libs/css/bootstrap/docs-assets/js/holder.js"></script>

<script>
$(document).ready(function(){
	$(document).on('mouseenter', '.product-img-thumb', function(){
		var data_img_id = $(this).attr('data-img-id');
		$('.product-img').hide();
		$('#product-img-'+data_img_id).show();
	});
	$('.add-to-cart-form').on('submit', function(){
		var event_code = $(this).find('.event-code').text();
		var quantity = $(this).find('.cart-quantity').val();
		window.location.href = "add_to_cart.php?id=" + event_code + "&quantity=" + quantity;
		return false;
	});

	// update quantity button
	$('.update-quantity-form').on('submit', function(){
		var event_code = $(this).find('.event-code').text();
		var quantity = $(this).find('.cart-quantity').val();
		window.location.href = "update_quantity.php?id=" + event_code + "&quantity=" + quantity;
		return false;
	});
});
</script>

</body>
</html>
