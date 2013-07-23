function setCookie(szName, szValue, szExpires, szPath, szDomain, bSecure)
{
 	var szCookieText = escape(szName) + '=' + escape(szValue);
	szCookieText +=	(szExpires ? '; EXPIRES=' + szExpires.toGMTString() : '');
	szCookieText += (szPath ? '; PATH=' + szPath : '');
	szCookieText +=	(szDomain ? '; DOMAIN=' + szDomain : '');
	szCookieText += (bSecure ? '; SECURE' : '');

	document.cookie = szCookieText;
}

//******************************************************************************************
// This functions reads & returns the cookie value of the specified cookie (by cookie name) 
//
// Prototype : getCookie(szName)
//******************************************************************************************

function getCookie(szName)
{
 	var szValue = null;
	if(document.cookie)	   //only if exists
	{
       	var arr = 		  document.cookie.split((escape(szName) + '=')); 
       	if(2 <= arr.length)
       	{
           	var arr2 = 	   arr[1].split(';');
       		szValue  = 	   unescape(arr2[0]);
       	}
	}
	return szValue;
}

//******************************************************************************************
// To delete a cookie, pass name of the cookie to be deleted
//
// Prototype : deleteCookie(szName)
//******************************************************************************************

function deleteCookie(szName)
{
 	var tmp = getCookie(szName);
	if(tmp) 
	{ setCookie(szName,tmp,(new Date(1))); }
}

//==========================================^-^==============================================//
//    This and many more interesting and usefull scripts at http://www.technofundo.com/		 //
//==========================================^-^==============================================//   