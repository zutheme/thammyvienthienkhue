/*var e_comment = document.getElementsByClassName("comment-details")[0];
var e_snip1197 = e_comment.getElementsByClassName("snip1197");
for (var i = e_snip1197.length - 1; i >= 0; i--) {
		console.log(e_snip1197[i]);
        e_snip1197[i].style.width = "50% !important";
      }*/
var e_frm_comment = document.getElementsByClassName("frm-comment")[0];
var e_lb_radio = e_frm_comment.getElementsByClassName('lb_radio');
var e_item = e_frm_comment.getElementsByClassName('item');
for(var t = 0; t < e_lb_radio.length; t++){
    e_lb_radio[t].addEventListener("click", function(){
  		var e_check = this.parentElement;
  		var e_selected = e_check.getElementsByClassName('rate')[0].setAttribute("checked", "checked");
  		var max = e_check.getElementsByClassName('rate')[0].value;
  		max = parseInt(max)+1;
  		//var e_star = e_check.getElementsByClassName('lb_radio')[0].getElementsByTagName("span")[0];
  		for(var t = 0; t < e_item.length; t++){
  			var _exist_class = e_item[t].getElementsByClassName('lb_radio')[0].getElementsByTagName("span")[0]
  			if(_exist_class.classList.contains('fa-star')){
  				_exist_class.className = _exist_class.className.replace(/\bfa-star\b/g, "");
  				_exist_class.classList.add("fa-star-o");
  			}
  		}
  		for(var k = 0; k < e_item.length; k++){
  			if(k == max) break;
  			var _exist_class = e_item[k].getElementsByClassName('lb_radio')[0].getElementsByTagName("span")[0]
  			if(_exist_class.classList.contains('fa-star-o')){
  				_exist_class.className = _exist_class.className.replace(/\bfa-star-o\b/g, "");
  				_exist_class.classList.add("fa-star");
  			}
  		}
  		// if(e_star.classList.contains('fa-star-o')){
  		// 	e_star.className = e_star.className.replace(/\bfa-star-o\b/g, "");
  		// 	e_star.classList.add("fa-star");
  		// }else{
  		// 	e_star.className = e_star.className.replace(/\bfa-star\b/g, "");
  		// 	e_star.classList.add("fa-star-o");
  		// }
  		//console.log(e_star);
	});  
}
function post_comment(element) {
	var e_frm = element.parentElement.parentElement.parentElement;
	var _security = e_frm.getElementsByClassName("my-special-string")[0].value;
	var _comment_post_ID = e_frm.getElementsByClassName("comment_post_ID")[0].value;
	var _comment_parent = e_frm.getElementsByClassName("comment_parent")[0].value;
	var _cmt_content = e_frm.getElementsByClassName("cmt-content")[0].value;
	var rate_value = 0;
	var rates = e_frm.getElementsByClassName("rate");
	for(var i = 0; i < rates.length; i++){
	    if(rates[i].checked){
	        rate_value = rates[i].value;
	    }
	}
	console.log(rate_value);
	return false;
  	var http = new XMLHttpRequest();
	var url = ajax_object.ajax_url+"?action=send_comment";
	var params = "security="+_security+"&comment_post_ID="+_comment_post_ID+"&comment_parent="+_comment_parent+"&comment_body="+_cmt_content;
	http.open("POST", url, true);
	//http.setRequestHeader("X-CSRF-TOKEN", _csrf_token);
	http.setRequestHeader("Accept", "application/json");
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	//var load = e_element.getElementsByClassName("loading-trash")[0];
	//load.style.display = "block";
	http.onreadystatechange = function() {
	    if(http.readyState == 4 && http.status == 200) {
	        var myArr = JSON.parse(this.responseText);
	        console.log(myArr);
	    }
	}
	http.send(params);
}
