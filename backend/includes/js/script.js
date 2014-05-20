var mainContent = "right_content";
var supplierImgCounter = 0;

function getAddCategory()
{
    getSSContent(mainContent, "getAddCategory", "");
}

function clearAddCategory()
{
    getSSContent('add_category_con', 'clearAddCategory', '');
}

function saveCategory()
{
    var parent_category_id = getComboVal('cbo_parent_category_id');
    var category_name = $('txt_category_name').value;
    var description = $('txt_description').value;

    var params = 'parent_category_id=' + parent_category_id + '&category_name=' + category_name + '&description=' +
	    description;
    getSSContent('add_category_con', 'saveCategory', params);
}

function getEditCategory(category_id)
{
    var params = 'category_id=' + category_id;
    getSSContent(mainContent, 'getEditCategory', params);
}

function editCategory(category_id)
{
    var parent_category_id = getComboVal('cbo_parent_category_id');
    var category_name = $('txt_category_name').value;
    var description = $('txt_description').value;

    var params = 'category_id=' + category_id + '&parent_category_id=' + parent_category_id + '&category_name=' +
	    category_name + '&description=' + description;
    getSSContent('edit_category_con', 'editCategory', params);
}

function getCategoryList()
{
    getSSContent(mainContent, "getCategoryList", "");
}

function deleteCategory(category_id)
{
    var params = 'category_id=' + category_id;
    getSSContent("conf_del_category", "deleteCategory", params);
}

function getAddCommand()
{
    getSSContent(mainContent, "getAddCommand", "");
}

function clearAddCommand()
{
    getSSContent('add_command_con', 'clearAddCommand', '');
}

function saveCommand()
{
    var fk_customer_id = $('txt_fk_customer_id').value;
    var status = $('cbo_status').options[$('cbo_status').selectedIndex].value;
    var date_created = $('txt_date_created').value;
    var date_delivered = $('txt_date_delivered').value;

    var params = 'fk_customer_id=' + fk_customer_id + '&status=' + status + '&date_created=' + date_created +
	    '&date_delivered=' + date_delivered;
    getSSContent('add_command_con', 'saveCommand', params);
}

function getEditCommand(command_id)
{
    var params = 'command_id=' + command_id;
    getSSContent(mainContent, 'getEditCommand', params);
}

function editCommand(command_id)
{
    var fk_customer_id = $('txt_fk_customer_id').value;
    var status = $('cbo_status').options[$('cbo_status').selectedIndex].value;
    var date_created = $('txt_date_created').value;
    var date_delivered = $('txt_date_delivered').value;

    var params = 'command_id=' + command_id + '&fk_customer_id=' + fk_customer_id + '&status=' + status +
	    '&date_created=' + date_created + '&date_delivered=' + date_delivered;
    getSSContent('edit_command_con', 'editCommand', params);
}

function getCommandList()
{
    getSSContent(mainContent, "getCommandList", "");
}

function deleteCommand(command_id)
{
    var params = 'command_id=' + command_id;
    getSSContent("conf_del_command", "deleteCommand", params);
}

function getAddCustomer()
{
    getSSContent(mainContent, "getAddCustomer", "");
}

function clearAddCustomer()
{
    getSSContent('add_customer_con', 'clearAddCustomer', '');
}

function saveCustomer()
{
    var name = $('txt_name').value;
    var surname = $('txt_surname').value;
    var street = $('txt_street').value;
    var address1 = $('txt_address1').value;
    var address2 = $('txt_address2').value;
    var mobile = $('txt_mobile').value;
    var type_of_customer = $('txt_type_of_customer').value;
    var email = $('txt_email').value;
    var login = $('txt_login').value;
    var password = $('txt_password').value;

    var params = 'name=' + name + '&surname=' + surname + '&street=' + street + '&address1=' + address1 + '&address2=' +
	    address2 + '&mobile=' + mobile + '&type_of_customer=' + type_of_customer + '&email=' + email + '&login=' +
	    login + '&password=' + password;
    getSSContent('add_customer_con', 'saveCustomer', params);
}

function getEditCustomer(customer_id)
{
    var params = 'customer_id=' + customer_id;
    getSSContent(mainContent, 'getEditCustomer', params);
}

function editCustomer(customer_id)
{
    var name = $('txt_name').value;
    var surname = $('txt_surname').value;
    var street = $('txt_street').value;
    var address1 = $('txt_address1').value;
    var address2 = $('txt_address2').value;
    var mobile = $('txt_mobile').value;
    var type_of_customer = $('txt_type_of_customer').value;
    var email = $('txt_email').value;

    var params = 'customer_id=' + customer_id + '&name=' + name + '&surname=' + surname + '&street=' + street +
	    '&address1=' + address1 + '&address2=' + address2 + '&mobile=' + mobile + '&type_of_customer=' +
	    type_of_customer + '&email=' + email;
    getSSContent('edit_customer_con', 'editCustomer', params);
}

function getCustomerList()
{
    getSSContent(mainContent, "getCustomerList", "");
}

function deleteCustomer(customer_id)
{
    var params = 'customer_id=' + customer_id;
    getSSContent("conf_del_customer", "deleteCustomer", params);
}

function getAddCustomerBasket()
{
    getSSContent(mainContent, "getAddCustomerBasket", "");
}

function clearAddCustomerBasket()
{
    getSSContent('add_customer_basket_con', 'clearAddCustomerBasket', '');
}

function saveCustomerBasket()
{
    var fk_command_id = $('txt_fk_command_id').value;
    var fk_product_id = $('txt_fk_product_id').value;
    var quantity = $('txt_quantity').value;

    var params = 'fk_command_id=' + fk_command_id + '&fk_product_id=' + fk_product_id + '&quantity=' + quantity;
    getSSContent('add_customer_basket_con', 'saveCustomerBasket', params);
}

function getEditCustomerBasket()
{
    getSSContent(mainContent, 'getEditCustomerBasket', params);
}

function editCustomerBasket()
{
    var fk_command_id = $('txt_fk_command_id').value;
    var fk_product_id = $('txt_fk_product_id').value;
    var quantity = $('txt_quantity').value;

    var params = 'fk_command_id=' + fk_command_id + '&fk_product_id=' + fk_product_id + '&quantity=' + quantity;
    getSSContent('edit_customer_basket_con', 'editCustomerBasket', params);
}

function getCustomerBasketList()
{
    getSSContent(mainContent, "getCustomerBasketList", "");
}

function deleteCustomerBasket()
{
    getSSContent("conf_del_customer_basket", "deleteCustomerBasket", params);
}

function getAddProduct()
{
    getSSContent(mainContent, "getAddProduct", "");
}

function clearAddProduct()
{
    getSSContent('add_product_con', 'clearAddProduct', '');
}

function saveProduct()
{
    var fk_category_id = getComboVal('cbo_parent_category_id');
    var product_name = $('txt_product_name').value;
    var description = $('txt_description').value;
    var normal_price = $('txt_normal_price').value;
    var promo_price = $('txt_promo_price').value;
    var image_link = $('frameProduct').contentWindow.document.getElementById('txt_image_link').value;

    var params = 'fk_category_id=' + fk_category_id + '&product_name=' + product_name + '&description=' + description +
	    '&normal_price=' + normal_price + '&promo_price=' + promo_price + '&image_link=' + image_link;
    getSSContent('add_product_con', 'saveProduct', params);
}

function getEditProduct(product_id)
{
    var params = 'product_id=' + product_id;
    getSSContent(mainContent, 'getEditProduct', params);
}

function editProduct(product_id)
{
    var fk_category_id = getComboVal('cbo_parent_category_id');
    var product_name = $('txt_product_name').value;
    var description = $('txt_description').value;
    var normal_price = $('txt_normal_price').value;
    var promo_price = $('txt_promo_price').value;
    var image_link = $('frameProduct').contentWindow.document.getElementById('txt_image_link').value;

    var params = 'product_id=' + product_id + '&fk_category_id=' + fk_category_id + '&product_name=' + product_name +
	    '&description=' + description + '&normal_price=' + normal_price + '&promo_price=' + promo_price +
	    '&image_link=' + image_link;
    getSSContent('edit_product_con', 'editProduct', params);
}

//function getProductList()
//{
//    getSSContent(mainContent, "getProductList", "");
//}

function deleteProduct(product_id)
{
    var params = 'product_id=' + product_id;
    getSSContent("conf_del_product", "deleteProduct", params);
}

function getAddUser()
{
    getSSContent(mainContent, "getAddUser", "");
}

function clearAddUser()
{
    getSSContent('add_user_con', 'clearAddUser', '');
}

function saveUser()
{
    var user_name = $('txt_user_name').value;
    var user_password = $('txt_user_password').value;
    var user_role = $('txt_user_role').value;

    var params = 'user_name=' + user_name + '&user_password=' + user_password + '&user_role=' + user_role;
    getSSContent('add_user_con', 'saveUser', params);
}

function getEditUser(user_id)
{
    var params = 'user_id=' + user_id;
    getSSContent(mainContent, 'getEditUser', params);
}

function editUser(user_id)
{
    var user_name = $('txt_user_name').value;
    var user_password = $('txt_user_password').value;
    var user_role = $('txt_user_role').value;

    var params = 'user_id=' + user_id + '&user_name=' + user_name + '&user_password=' + user_password + '&user_role=' +
	    user_role;
    getSSContent('edit_user_con', 'editUser', params);
}

function getUserList()
{
    getSSContent(mainContent, "getUserList", "");
}

function deleteUser(user_id)
{
    var params = 'user_id=' + user_id;
    getSSContent("conf_del_user", "deleteUser", params);
}

function checkLogin()
{
    var username = $('username').value;
    var password = $('password').value;

    var params = 'username=' + username + '&password=' + password;
    getSSContent('main_container', 'checkLogin', params);
}

function logOut()
{
    getSSContent('main_container', 'logOut', "");
}

function validateForm(form)
{
    if (form.uploadedfile.value == '')
    {
	alert('Choose an image!');

	return false;
    }
    return true;
}

function updateProductList()
{
    var categoryId = $("#cbo_category").val();
    var offset = $("#txt_offset").val();
    var params = {"category_id": categoryId, "offset": offset};
    getSSContent("updateProductList", "product_list_con", params);
}

function updateFrontProductList(id)
{
    var offset = $("#txt_offset").val();
    var params = {"category_id": id, "offset": offset};
    getSSContent("updateFrontProductList", "front_product_list_con", params);
}

function updateFeaturedProductList()
{
    var offset = $("#txt_offset").val();
    var params = {"offset": offset};
    getSSContent("updateFeaturedProductList", "featured_product_list_con", params);
}

function updateCategoryList()
{
    var categoryId = $("#cbo_category").val();
    var offset = $("#txt_offset").val();
    var params = {"category_id": categoryId, "offset": offset};
    getSSContent("updateCategoryList", "category_list_con", params);
}

function updateCustomerList()
{
    var offset = $("#txt_offset").val();
    var params = {"offset": offset};
    getSSContent("updateCustomerList", "customer_list_con", params);
}

function updateCommmandList()
{
    var offset = $("#txt_offset").val();
    var params = {"offset": offset};
    getSSContent("updateCommandList", "command_list_con", params);
}

function getModalAddInBasket(id)
{
    var params = {"id": id};
    getSSContent("getModalAddInBasket", "myModal", params);
}

function addToCart(id)
{
    $("#cmd_add_to_cart").addClass("disabled");
    var qty = $("#txt_product_qty").val();
    var params = {"id": id, "qty": qty};
    getSSContent("addToCart", "add_to_cart_result_con", params);
}

function updateCartSummary()
{
    getSSContent("updateCartSummary", "shoppingBasket", "");
}

function getAddProductInCart(productId)
{
    var params = {"product_id": productId};
    getSSContent("getAddProductInCart", "modal_content", params);
}

function editCartItem(id)
{
    var quantity = $("#txt_product_qty").val();
    var params = {"product_id": id, "quantity": quantity};
    getSSContent("editCartItem", "edit_cart_item_result_con", params);
}

function updateCartList()
{
    getSSContent("updateCartList", "cart_product_list_con", "");
}

function getEditProductInCart(productId, commandId)
{
    var params = {"product_id": productId, "command_id": commandId};
    getSSContent("getEditProductInCart", "modal_content", params);
}

function getDeleteProductInCart(productId)
{
    var params = {"product_id": productId};
    getSSContent("getDeleteProductInCart", "modal_content", params);
}

function deleteProductInCart(productId)
{
    var params = {"product_id": productId};
    getSSContent("deleteProductInCart", "myModal", params);
}

function deleteCartItem(productId)
{
    var params = {"product_id": productId};
    getSSContent("deleteCartItem", "delete_cart_item_result_con", params);
}

function confirmCommand()
{
    var params = "";

    if ($('#cbo_dropoint').length > 0)
    {
	var dropointId = $('#cbo_dropoint').val();
	params = {"dropoint_id": dropointId};
    }

    getSSContent("confirmCommand", "confirm_command_con", params);
}

function getAboutDetails()
{
    getSSContent("getAboutDetails", "infoModal", "");
}

function updateCustomerBasket(row, command, product)
{
    var quantity = $('#txt_quantity_' + row).val();

    var params = 'command_id=' + command + '&quantity=' + quantity + '&product=' + product;
    getSSContent('updateCustomerBasket', 'specificBasket', params);
}

function editCommand(command_id)
{
    var fk_customer_id = $('#txt_fk_customer_id').val();
    var status = $('#cbo_status').val(); //getComboVal('cbo_status');

    var params = 'command_id=' + command_id + '&fk_customer_id=' + fk_customer_id + '&status=' + status;
    getSSContent('editCommand', 'edit_command_con', params);
}

function initSupplierFlow()
{
    var array = $(".sim1");

    window.setInterval(function()
    {
	if (supplierImgCounter == (array.length))
	{
	    supplierImgCounter = 0;
	}

	$("#sim_" + (supplierImgCounter + 1)).fadeOut();
	$("#sim_" + (supplierImgCounter + 1)).appendTo('#supplier_image_container');
	$("#sim_" + (supplierImgCounter + 1)).fadeIn();

	supplierImgCounter++;
    }, 3000);
}

function deleteProductsWithoutImages()
{
    getSSContent("deleteProductsWithoutImages", "del_product_con", "");
}

function sendContactMessage()
{
    var name = $("#txt_name").val();
    var email = $("#txt_email").val();
    var mobile = $("#txt_mobile").val();
    var message = $("#txt_message").val();

    var params = {"name": name, "email": email, "mobile": mobile, "message": message};
    getSSContent("sendContactMessage", "con_contact", params);
}

function initialiseProductSlider()
{
    $('.product-image-slider').flexslider({
	direction: "vertical",
	controlNav: false,
	directionNav: true,
	pauseOnHover: true,
	slideshowSpeed: 10000
    });
}

function sendContact()
{
    var name = $("#txt_name").val();
    var email = $("#txt_email").val();
    var mobile = $("#txt_mobile").val();
    var comment = $("#txt_comment").val();
    var params = {"name": name, "email": email, "mobile": mobile, "comment": comment};
    getSSContent("sendContact", "contact_con", params);
}

function updateDropointCheckoutDisplay()
{
    $('#btn_confirm_button').hide();
    var dropointId = $('#cbo_dropoint').val();
    var params = {"dropoint_id": dropointId};
    getSSContent("updateDropointCheckoutDisplay", "update_dropoint_checkout_con", params);
}