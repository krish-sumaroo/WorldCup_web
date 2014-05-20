/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function getContactDetails()
{
    getMainContent('mycontainer', 'getContactDetails', '');
}


function getMyAccount()
{
    getMainContent('mycontainer', 'getMyAccount', '');
}



function getShoppingCart()
{
    getMainContent('mycontainer', 'getShoppingCart', '');
}


function getProductsList(category)
{
    var params = 'category=' + category;
    getMainContent('mycontainer', 'getProductsList', params);
}


function getTheProductDetails(productId)
{
    var params = 'productId=' + productId;
    getMainContent('mycontainer', 'getTheProductDetails', params);
}


function getAboutDetails()
{
    getMainContent('mycontainer', 'getAboutDetails', '');
}



function calculateAmount(price)
{
    $('amt').value = (price *  $('qty').value).toFixed(2) ;
}

function updateShoppingCart(productId)
{
    var quantity = $('qty').value;
    var params = 'productId=' + productId + '&quantity=' + quantity ; 
    getMainContent('amountTotal', 'updateShoppingCart', params);
   
}


function updateShoppingCart2(productId)
{
    var quantity = $('qty_' + productId).value;
    var params = 'productId=' + productId + '&quantity=' + quantity ;
    getMainContent('mycontainer', 'updateShoppingCart2', params);
   
}



function removeFromCart(productId)
{
    var params = 'productId=' + productId  ;
    getMainContent('mycontainer', 'removeFromCart', params);
   
}



function getRegistration(option)
{
    var params = 'option=' + option  ;
    getMainContent('mycontainer', 'getRegistration', params);
}



function getCheckOut()
{
    getMainContent('mycontainer', 'getCheckOut', '');
}

function getMyAccountCheckout()
{
    getMainContent('mycontainer', 'getMyAccountCheckout', '');
}

function registerUser(option)
{
    if(validateUser())
    { 
        var username  = $('username').value ;    
                     
        var params =  'username=' + username + '&option=' + option;
        getMainContent('userExists', 'getUserExists', params);
   
    }  
    
}


function addTheUser(option)
{
    if(validateUser())
    {   
        var firstname = $('firstname').value ;
        var lastname  = $('lastname').value ;
        var email  = $('email').value ;
        var telephone  = $('telephone').value ;
        var address1  = $('address1').value ;
        var address2  = $('address2').value ;
        var city  = $('city').value ;
        var username  = $('username').value ;
        var password  = $('password').value ;
       
        
                     
        var params = 'firstname=' + firstname + '&lastname=' + lastname + '&email=' + email + '&telephone=' + telephone + '&address1=' + address1 + '&address2=' + address2 + '&city=' + city + '&username=' + username + '&password=' + password + '&option=' + option;
        getMainContent('mycontainer', 'registerUser', params);
   
    }  
    
}


function validateUser()
{
    if($('firstname').value == "")
    {
        alert("Please enter first name");
        return false;
    }    
    
    if($('lastname').value == "")
    {
        alert("Please enter last name");
        return false;
    } 
    
    if($('email').value == "")
    {
        alert("Please enter email");
        return false;
    } 
    
  
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test($('email').value))
    {
        alert('Please provide a valid email address');
        return false;
    }
    
    if($('address1').value == "")
    {
        alert("Please enter address1");
        return false;
    } 
        
    if($('city').value == "")
    {
        alert("Please enter city");
        return false;
    } 
    
    if($('telephone').value == "")
    {
        alert("Please enter telephone");
        return false;
    } 
    
    if($('username').value == "")
    {
        alert("Please enter username");
        return false;
    } 
    
    if($('password').value == "")
    {
        alert("Please enter password");
        return false;
    } 
    
    
    if($('password').value != $('confpassword').value)
    {
        alert("Please confirm your password correctly");
        return false;
    }  
    
    return true;
    
}



function checkCustomerLogin(option)
{
    var username = $('username').value;
    var password = $('password').value;   

    var params = 'username=' + username + '&password=' + password + '&option=' + option;
    getMainContent('mycontainer', 'checkCustomerLogin', params);
}



function UpdateCustomer(option)
{
    if(validateUser2())
    { 
        var firstname = $('firstname').value ;
        var lastname  = $('lastname').value ;
        var email  = $('email').value ;
        var telephone  = $('telephone').value ;
        var address1  = $('address1').value ;
        var address2  = $('address2').value ;
        var city  = $('city').value ;       
      
        var params = 'firstname=' + firstname + '&lastname=' + lastname + '&email=' + email + '&telephone=' + telephone + '&address1=' + address1 + '&address2=' + address2 + '&city=' + city + '&option=' + option;
   
        getMainContent('mycontainer', 'UpdateCustomer', params);
   
    }  
    
}

function validateUser2()
{
    if($('firstname').value == "")
    {
        alert("Please enter first name");
        return false;
    }    
    
    if($('lastname').value == "")
    {
        alert("Please enter last name");
        return false;
    } 
    
    if($('email').value == "")
    {
        alert("Please enter email");
        return false;
    } 
    
  
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test($('email').value))
    {
        alert('Please provide a valid email address');
        return false;
    }
    
    if($('address1').value == "")
    {
        alert("Please enter address1");
        return false;
    } 
    
    
    if($('city').value == "")
    {
        alert("Please enter city");
        return false;
    } 
    
    if($('telephone').value == "")
    {
        alert("Please enter telephone");
        return false;
    } 

    
    return true;
    
}

function gotoConfirm()
{
    getMainContent('mycontainer', 'getConfirmCheckout', ''); 
}

function ConfirmOrder()
{
    getMainContent('mycontainer', 'confirmOrder', ''); 
}   

function getShoppingBasket()
{
    getMainContent('shoppingBasket', 'getShoppingBasket', ''); 
}   

function getLogOut()
{
    getMainContent('logOut', 'getLogOut', ''); 
}


function customerLogout()
{
    getMainContent('logOut', 'customerLogout', ''); 
  
} 

function getUserExists()
{
    getMainContent('userExists', 'getUserExists', '');     
}



function contactUs()
{
    var name = $('yourname').value ;
    var message = $('message').value ;
    var email  = $('email').value ;
           
    var params = 'name=' + name + '&message=' + message + '&email=' + email;
   
    getMainContent('contactDetails', 'contactUs', params);     
}