function updateProductList()
{
    var categoryId = $("#cbo_category").val();
    var offset = $("#txt_offset").val();
    var params = {"category_id": categoryId, "offset": offset};
    getSSContent("updateProductList", "product_list_con", params);
}

function getProductList(categoryId, offset)
{
    var params = {"category_id": categoryId, "offset": offset};
    getSSContent("updateProductList", "product_list_con", params);
}

function updateFeaturedProduct(id)
{
    var con = "feature_action_con_" + id;
    $("#" + con).show();
    var featured = $("#cbo_featured_prod_" + id).val();
    var params = {"id": id, "featured": featured};
    getSSContent("updateFeaturedProduct", con, params);
}

function updateHomeFeaturedProduct(id)
{
    var con = "feature_action_con_" + id;
    $("#" + con).show();
    var featured = $("#cbo_featured_prod_" + id).val();
    var params = {"id": id, "featured": featured};
    getSSContent("updateHomeFeaturedProduct", con, params);
}

function getAddClerk()
{
    $("#con_add_clerk").show();
}

function addClerk()
{
    var email = $("#txt_email").val();
    var params = {"email": email};
    getSSContent("addClerk", "save_clerk_con", params);
}

function reloadClerkList()
{
    getSSContent("reloadClerkList", "clerk_list_con", "");
}

function deleteClerk(id)
{
    var conf = confirm("Delete clerk?");

    if (conf)
    {
	var con = "clerk_action_con_" + id;
	var params = {"id": id};
	getSSContent("deleteClerk", con, params);
    }
}

function deactivateBanner(id)
{
    var con = "act_con_" + id;
    var params = {"id": id};
    var conf = confirm("Deactivate banner? Note that this will disable it from your front website and it will NOT appear on your homepage.");

    if (conf)
    {
	getSSContent("deactivateBanner", con, params);
    }
}

function activateBanner(id)
{
    var con = "act_con_" + id;
    var params = {"id": id};
    var conf = confirm("Activate banner? Note that this will enable it in front website and it will appear on your homepage.");

    if (conf)
    {
	getSSContent("activateBanner", con, params);
    }
}

function deleteBanner(id)
{
    var con = "action_con_" + id;
    var params = "id=" + id;
    var conf = confirm("Are you sure you want to delete the banner? Note that after this action, the banner will be deleted and will no longer appear on your home page.");

    if (conf)
    {
	getSSContent("deleteBanner", con, params);
    }
}

function updateCommandStatus(id)
{
    var conf = confirm("Confirm change status?");

    if (conf)
    {
	var status = $("#cbo_status").val();
	var params = {"id": id, "status": status};
	getSSContent("updateCommandStatus", "command_update_con", params);
    }
    else
    {
	initialStatus = $("#initial_status_con").val();
	$("#cbo_status").val(initialStatus);
    }
}

function initialiseClEditor(id)
{
    $("#" + id).cleditor({
	width: "auto",
	height: "auto"
    });
}

function getEditAboutUsExtended()
{
    var con = "edit_website_info_text_con_about_us";
    $("#" + con).fadeIn();
    getSSContent("getEditAboutUsExtended", con, "");
}

function editAboutUsExtended()
{
    var con = "website_info_act_con_about_us";
    var text = $("#txt_about_us").val();
    var params = {"text": text};
    getSSContent("editAboutUsExtended", con, params);
}

function reloadAboutUsExtended()
{
    var con = "website_info_text_con_about_us";
    getSSContent("reloadAboutUsExtended", con, "");
}

function getEditDisclaimer()
{
    var con = "edit_website_info_text_con_disclaimer";
    $("#" + con).fadeIn();
    getSSContent("getEditDisclaimer", con, "");
}

function editDisclaimer()
{
    var con = "website_info_act_con_disclaimer";
    var text = $("#txt_disclaimer").val();
    var params = {"text": text};
    getSSContent("editDisclaimer", con, params);
}

function reloadDisclaimer()
{
    var con = "website_info_text_con_disclaimer";
    getSSContent("reloadDisclaimer", con, "");
}

function getEditPrivacyPolicy()
{
    var con = "edit_website_info_text_con_privacy_policy";
    $("#" + con).fadeIn();
    getSSContent("getEditPrivacyPolicy", con, "");
}

function editPrivacyPolicy()
{
    var con = "website_info_act_con_privacy_policy";
    var text = $("#txt_privacy_policy").val();
    var params = {"text": text};
    getSSContent("editPrivacyPolicy", con, params);
}

function reloadPrivacyPolicy()
{
    var con = "website_info_text_con_privacy_policy";
    getSSContent("reloadPrivacyPolicy", con, "");
}

function getEditTermsConditions()
{
    var con = "edit_website_info_text_con_terms_conditions";
    $("#" + con).fadeIn();
    getSSContent("getEditTermsConditions", con, "");
}

function editTermsConditions()
{
    var con = "website_info_act_con_terms_conditions";
    var text = $("#txt_terms_conditions").val();
    var params = {"text": text};
    getSSContent("editTermsConditions", con, params);
}

function reloadTermsConditions()
{
    var con = "website_info_text_con_terms_conditions";
    getSSContent("reloadTermsConditions", con, "");
}

function getEditReturnPolicy()
{
    var con = "edit_website_info_text_con_return_policy";
    $("#" + con).fadeIn();
    getSSContent("getEditReturnPolicy", con, "");
}

function editReturnPolicy()
{
    var con = "website_info_act_con_return_policy";
    var text = $("#txt_return_policy").val();
    var params = {"text": text};
    getSSContent("editReturnPolicy", con, params);
}

function reloadReturnPolicy()
{
    var con = "website_info_text_con_return_policy";
    getSSContent("reloadReturnPolicy", con, "");
}

function reorderBanner()
{
    var idArray = $("#sortable").sortable("toArray");
    var params = {"id": idArray};
    getSSContent("reorderBanner", "reorder_banner_con", params);
}

function deleteDropoint(id)
{
    var conf = confirm("Delete this drop point?");

    if (conf)
    {
	var con = "dropoint_action_con_" + id;
	var params = {"id": id};
	getSSContent("deleteDropoint", con, params);
    }
}

function updateMemberBusinessDetails()
{
    var name = $("#txt_business_name").val();
    var brn = $("#txt_brn").val();
    var street = $("#txt_business_street").val();
    var city = $("#txt_business_city").val();
    var mobile = $("#txt_business_mobile").val();
    var email = $("#txt_business_email").val();
    var phone = $("#txt_business_phone").val();
    var fax = $("#txt_business_fax").val();
    var facebook = $("#txt_facebook").val();
    var twitter = $("#txt_twitter").val();
    var linkedin = $("#txt_linkedin").val();
    var googleplus = $("#txt_google_plus").val();
    var params = {"name": name, "brn": brn, "street": street, "city": city, "mobile": mobile, "email": email, "phone": phone,
	"fax": fax, "facebook": facebook, "twitter": twitter, "linkedin": linkedin, "googleplus": googleplus};
    getSSContent("updateMemberBusinessDetails", "business_details_con", params);
}

function updateMemberPersonalDetails()
{
    var surname = $("#txt_surname").val();
    var otherName = $("#txt_other_name").val();
    var mobile = $("#txt_mobile").val();
    var email = $("#txt_email").val();
    var street = $("#txt_street").val();
    var city = $("#txt_city").val();
    var phone = $("#txt_phone").val();
    var fax = $("#txt_fax").val();
    var params = {"surname": surname, "other_name": otherName, "mobile": mobile, "email": email, "street": street,
	"city": city, "phone": phone, "fax": fax};
    getSSContent("updateMemberPersonalDetails", "personal_settings_con", params);
}

function updateMemberPassword()
{
    var oldPassword = $("#txt_old_password").val();
    var newPassword = $("#txt_new_password").val();
    var confPassword = $("#txt_conf_new_password").val();
    var params = {"old_password": oldPassword, "new_password": newPassword, "conf_password": confPassword};
    getSSContent("updateMemberPassword", "password_settings_con", params);
}

function deleteMemberLogo()
{
    var conf = confirm("Delete logo?");

    if (conf)
    {
	getSSContent("deleteMemberLogo", "logo_details_con", "");
    }
}

function deleteBackgroundImage()
{
    var conf = confirm("Delete background image?");

    if (conf)
    {
	getSSContent("deleteBackgroundImage", "background_image_details_con", "");
    }
}

function getDeactivateCategory(id)
{
    var params = {"id": id};
    getSSContent("getDeactivateCategory", "modal_content", params);
}

function getActivateCategory(id)
{
    var params = {"id": id};
    getSSContent("getActivateCategory", "modal_content", params);
}

function deactivateCategory(id)
{
    var con = "status_action_con_" + id;
    var params = {"id": id};
    getSSContent("deactivateCategory", con, params);
}

function activateCategory(id)
{
    var con = "status_action_con_" + id;
    var params = {"id": id};
    getSSContent("activateCategory", con, params);
}

function reloadCategoryStatus(id)
{
    var con = "status_con_" + id;
    var params = {"id": id};
    getSSContent("reloadCategoryStatus", con, params);
}

function getDeactivateProduct(id)
{
    var params = {"id": id};
    getSSContent("getDeactivateProduct", "modal_content", params);
}

function getActivateProduct(id)
{
    var params = {"id": id};
    getSSContent("getActivateProduct", "modal_content", params);
}

function deactivateProduct(id)
{
    var con = "status_action_con_" + id;
    var params = {"id": id};
    getSSContent("deactivateProduct", con, params);
}

function activateProduct(id)
{
    var con = "status_action_con_" + id;
    var params = {"id": id};
    getSSContent("activateProduct", con, params);
}

function reloadProductStatus(id)
{
    var con = "status_con_" + id;
    var params = {"id": id};
    getSSContent("reloadProductStatus", con, params);
}