/* 
Function to check US Zip Code
*/
function isZipCode(s) 
{
          
}

/* 
Function to check UsPhoneNo: requires object as parameter 
*/

// Fill Next Phone
function tabNext(obj,event,len,next_field) {
	if (event == "down") {phone_field_length=obj.value.length;}
	else if (event == "up") {
		if (obj.value.length != phone_field_length) {
			phone_field_length=obj.value.length;
			if (phone_field_length == len) {next_field.focus();}
			}
		}
	}
function ValidateUrl(txtUrl) 
{ 
    var v = new RegExp(); 
    v.compile("^[A-Za-z]+://[A-Za-z0-9-_]+\\.[A-Za-z0-9-_%&\?\/.=]+$"); 
    if (!v.test(txtUrl)) 
    { 
        alert("You must supply a valid URL."); 
        return false; 
    } 
} 

function IsValidUrl(txtUrl)
{
    var v = new RegExp(); 
    v.compile("^[A-Za-z]+://[A-Za-z0-9-_]+\\.[A-Za-z0-9-_%&\?\/.=]+$"); 
    if (!v.test(txtUrl.value))
    {       
        return false; 
    }
    else
    {
        return true;
    }
}
function checkURL(value) 
{
	var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.){2}");
	if(urlregex.test(value))
	{
	return(true);
	}
	return(false);
}

function IsValidUSPhone(strFieldName)     {
	//alert(strFieldName);
     var strValue = strFieldName.value;     
     var objRegExp  = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;
      if(!objRegExp.test(strValue))
	  {
		  return false;
	  }
	  else
	  {
		  return true;
	  }
}
/*(
function IsValidUSZIP(strFieldName)     {
	alert(strFieldName);
     var strValue = strFieldName.value;
     var objRegExp  = /(^\d{5}$);
      if(!objRegExp.test(strValue))
	  {
		  return false;
	  }
	  else
	  {
		  return true;
	  }
}
*/
/* 
Function to check IP: requires object as parameter 
*/
function IsIP(ParamTxtobj)
{
	var makename=ParamTxtobj;
	var ascCode,i,strRet;
	var isError,makenameval;
	var parms;
	makenameval=ParamTxtobj.value.toLowerCase();
	strRet="";
	isError=false;
	if((makenameval.indexOf('.')==-1)||(makenameval.indexOf('.')==0))	
	{
		isError=true;
		return false;					
	}
	if(isError==false)
	{
		parms = makenameval.split('.');
		//alert(parms.length);	
		//return false;	
		if(parms.length!=4)
		{
			isError=true			
		}		
		if(isError==false)
		{
			if(parms.length==4)
			{	
				for (var i=0; i<parms.length; i++)
				{
					if((parms[i].length<1)||(parms[i].length>3))
					{
						isError=true;
						break;		
					}
					if(isError==false)
					{
						for (var j=0; j<parms[i].length; j++)
						{
							ascCode=parms[i].charCodeAt(j);
							//alert(ascCode);
							if((ascCode>47 && ascCode<58 ))
							{
								isError=false;
							}	
							else
							{
								isError=true;
							}
							if (isError==true) 
							break;			
						}	
					}	
					if (isError==true) 
					break;									
				}								
			}			
		}								
	}
	//alert(isError);
	if (isError==true) 
	{
		return false;
	}
	else
	{
		return true;
	}
}
/* 
Function to check mail address: requires object as parameter 
*/
function IsMailAddress(ParamTxtobj)
{
	var makename=ParamTxtobj;
	var ascCode,i,strRet;
	var isError,makenameval;
	var parms;
	makenameval=ParamTxtobj.value.toLowerCase();
	strRet="";
	isError=false;
	if((makenameval.indexOf('.')==-1)||(makenameval.indexOf('.')==0))	
	{
		isError=true;
		return false;					
	}
	if(isError==false)
	{
		parms = makenameval.split('.');
		//alert(parms.length);	
		//return false;	
		if((parms.length<3)||(parms.length>4))
		{
			isError=true			
		}		
		if(isError==false)
		{
			if(parms.length==3)
			{	
				for (var i=0; i<parms.length; i++)
				{
					for (var j=0; j<parms[i].length; j++)
					{
						ascCode=parms[i].charCodeAt(j);	
						if((ascCode>96 && ascCode<123 ))
						{
							isError=false;
						}	
						else
						{
							isError=true;
						}						
						if (isError==true) 
						break;			
					}	
					if (isError==true) 
					break;					
				}								
			}			
		}	
		if(isError==false)
		{
			if(parms.length==4)
			{	
				for (var i=0; i<parms.length; i++)
				{
					if((parms[i].length<1)||(parms[i].length>3))
					{
						isError=true;
						break;		
					}
					if(isError==false)
					{
						for (var j=0; j<parms[i].length; j++)
						{
							ascCode=parms[i].charCodeAt(j);	
							if((ascCode>47 && ascCode<58 ))
							{
								isError=false;
							}	
							else
							{
								isError=true;
							}
							if (isError==true) 
							break;			
						}	
					}	
					if (isError==true) 
					break;									
				}								
			}			
		}								
	}
	
	if (isError==true) 
	{
		return false;
	}
	else
	{
		return true;
	}
}
/* 
Function to check mail address: requires object as parameter 
*/
function IsValidEmail(txtEmailId)
{
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(txtEmailId.value)== false)
	{		
		return false;
	}
}
/* 
Function to check mail address: requires text as parameter 
*/
function IsValidEmailText(txtEmailId)
{
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(txtEmailId)== false)
	{		
		return false;
	}
}
/*

Function to check UserID: requires object as parameter 
*/
function IsUserID(ParamTxtobj)
{
	var makename=ParamTxtobj;
	var ascCode,i,strRet;
	var isError,makenameval;
	makenameval=makename.value.toLowerCase();
	strRet="";
	for(i=0;i<makenameval.length;i++)
	{   
		ascCode=makenameval.charCodeAt(i);
		//96-123 - small letter
		//10 - end
		//47-57 - numeric(0-9)
		//45 - -
		//95 - _
		//46 - .		
		if((ascCode>96 && ascCode<123 )|| ascCode==10 || ascCode>47 && ascCode<58 || ascCode==45|| ascCode==95 || ascCode==46)
		{	isError=false; }
		else
		{isError=true;}
		
		if (isError==true) 
		break;
		
	}
	if (isError==true) 
	{
		return false;
	}
	else
	{
		return true;
	}
}
/* 
Function to check Name: requires object as parameter 
*/
function IsName(ParamTxtobj)
{
	var makename=ParamTxtobj;
	var ascCode,i,strRet;
	var isError,makenameval;
	makenameval=makename.value.toLowerCase();
	strRet="";
	for(i=0;i<makenameval.length;i++)
	{   
		ascCode=makenameval.charCodeAt(i);
		//alert(ascCode);
		//96-123 - small letter
		//10 - end
		//32 - space
		//39 - '	
		if((ascCode>96 && ascCode<123 )|| ascCode==10 || ascCode==32 || ascCode==39)
		{	isError=false; }
		else
		{isError=true;}
		
		if (isError==true) 
		break;
		
	}
	if (isError==true) 
	{
		return false;
	}
	else
	{
		return true;
	}
}
/* 
Function to check state,city,country: requires object as parameter 
*/
function IsState(ParamTxtobj)
{
	var makename=ParamTxtobj;
	var ascCode,i,strRet;
	var isError,makenameval;
	makenameval=makename.value.toLowerCase();
	strRet="";
	for(i=0;i<makenameval.length;i++)
	{   
		ascCode=makenameval.charCodeAt(i);
		//96-123 - small letter
		//10 - end
		//32 - space
		//39 - '
		//38 - &
		//44 - ,		
		if((ascCode>96 && ascCode<123 )|| ascCode==10 || ascCode==32 || ascCode==39 || ascCode==38 || ascCode==44)
		{	isError=false; }
		else
		{isError=true;}
		
		if (isError==true) 
		break;
		
	}
	if (isError==true) 
	{
		return false;
	}
	else
	{
		return true;
	}
}
/* 
Function to check Address: requires object as parameter 
*/
function IsAddress(ParamTxtobj)
{
	var makename=ParamTxtobj;
	var ascCode,i,strRet;
	var isError,makenameval;
	makenameval=makename.value.toLowerCase();
	strRet="";
	for(i=0;i<makenameval.length;i++)
	{   
		ascCode=makenameval.charCodeAt(i);
		//96-123 - small letter
		//10 - end
		//32 - space
		//47-57 - numeric(0-9)
		//39 - '
		//44 - ,
		//38 - &
		//45 - -
		//95 - _
		////46 - .	
		if((ascCode>96 && ascCode<123 )|| ascCode==10 || ascCode==32 || ascCode>47 && ascCode<58 || ascCode==39 || ascCode==44|| ascCode==38|| ascCode==45|| ascCode==95)
		{	
			isError=false; 
		}
		else
		{
			isError=true;
		}		
		if(isError==true) 
		break;
		
	}
	if (isError==true) 
	{
		return false;
	}
	else
	{
		return true;
	}
}	
/* 
Function to check Address: requires object as parameter 
*/
function IsMailContent(ParamTxtobj)
{
	var makename=ParamTxtobj;
	var ascCode,i,strRet;
	var isError,makenameval;
	makenameval=makename.value.toLowerCase();
	strRet="";
	for(i=0;i<makenameval.length;i++)
	{   
		ascCode=makenameval.charCodeAt(i);
		//alert(ascCode);		
		//96-123 - small letter
		//10 - end
		//32 - space
		//47-57 - numeric(0-9)
		//39 - '
		//44 - ,
		//38 - &
		//45 - -
		//95 - _
		////46 - .	
		//58 - :
		if((ascCode>96 && ascCode<123 )|| ascCode==10 || ascCode==32 || ascCode>47 && ascCode<58 || ascCode==39 || ascCode==44|| ascCode==38|| ascCode==45|| ascCode==95|| ascCode==58)
		{	
			isError=false; 
		}
		else
		{
			isError=true;
		}		
		if(isError==true) 
		break;
		
	}
	if (isError==true) 
	{
		return false;
	}
	else
	{
		return true;
	}
}
/* 
Function to check Address: requires object as parameter 
*/
function IsDescription(ParamTxtobj)
{
	var makename=ParamTxtobj;
	var ascCode,i,strRet;
	var isError,makenameval;
	makenameval=makename.value.toLowerCase();
	strRet="";
	for(i=0;i<makenameval.length;i++)
	{   
		ascCode=makenameval.charCodeAt(i);
		//96-123 - small letter
		//10 - end
		//32 - space
		//47-57 - numeric(0-9)
		//39 - '
		//44 - ,
		//38 - &
		//45 - -
		//95 - _
		////46 - .	
		////13 - enter
		////13 - enter
		//@-64
		if((ascCode>96 && ascCode<123 )|| ascCode==10 || ascCode==32 || ascCode>47 && ascCode<58 || ascCode==39 || ascCode==44|| ascCode==38|| ascCode==45|| ascCode==95|| ascCode==13|| ascCode==64)
		{	
			isError=false; 
		}
		else
		{
			isError=true;
		}		
		if(isError==true) 
		break;
		
	}
	if (isError==true) 
	{
		return false;
	}
	else
	{
		return true;
	}
}	
/* 
Function to check string value : requires object as parameter 
*/
function IsString(ParamTxtobj)
{
	var makename=ParamTxtobj;
	var ascCode,i,strRet;
	var isError,makenameval;
	makenameval=makename.value.toLowerCase();
	strRet="";
	for(i=0;i<makenameval.length;i++)
	{   
		ascCode=makenameval.charCodeAt(i);
		//96-123 - small letter
		//10 - end		
		if((ascCode>96 && ascCode<123 )|| ascCode==10)
		{	
			isError=false; 
		}
		else
		{
			isError=true;
		}		
		if(isError==true) 
		break;
		
	}
	if (isError==true) 
	{
		return false;
	}
	else
	{
		return true;
	}
}		
/* 
Function to check Alpha Numeric value : requires object as parameter 
*/
function IsAlphaNumeric(ParamTxtobj)
{
	var makename=ParamTxtobj;
	var ascCode,i,strRet;
	var isError,makenameval;
	makenameval=makename.value.toLowerCase();
	strRet="";
	for(i=0;i<makenameval.length;i++)
	{   
		ascCode=makenameval.charCodeAt(i);
		//96-123 - small letter
		//10 - end		
		//47-57 - numeric(0-9)		
		if((ascCode>96 && ascCode<123 )|| ascCode==10 || ascCode>47 && ascCode<58 )
		{	
			isError=false; 
		}
		else
		{
			isError=true;
		}		
		if(isError==true) 
		break;
		
	}
	if (isError==true) 
	{
		return false;
	}
	else
	{
		return true;
	}
}	
/* 
Function to check Numeric value : requires object as parameter 
*/
function IsNumeric(ParamTxtobj)
{
	var makename=ParamTxtobj;
	var ascCode,i,strRet;
	var isError,makenameval;
	var countDecimal=1;
	makenameval=makename.value.toLowerCase();
	strRet="";
	
	for(i=0;i<makenameval.length;i++)
	{   
		ascCode=makenameval.charCodeAt(i);	
		//10 - end		
		//47-57 - numeric(0-9)		
		//46 - .
		//96-123 - small letter
		if(ascCode==45 && i==0)
		{
		    isError=false; 
		}
		else if(ascCode==43 && i==0)
		{
		    isError=false; 
		}
		else if(ascCode==46 && countDecimal==1)
		{
		    isError=false;
		    countDecimal=countDecimal+1;		    
		}
		else if(ascCode==10 || ascCode>47 && ascCode<58 )
		{	
			isError=false; 
		}	
		
		else
		{
			isError=true;
		}		
		if(isError==true) 
		break;
		
	}
	if (isError==true) 
	{
		return false;
	}
	else
	{
		return true;
	}
}
/* 
Function to check Numeric value : requires object as parameter 
*/
function IsPureInteger(ParamTxtobj)
{
	var makename=ParamTxtobj;
	var ascCode,i,strRet;
	var isError,makenameval;
	makenameval=makename.value.toLowerCase();
	strRet="";
	for(i=0;i<makenameval.length;i++)
	{   
		ascCode=makenameval.charCodeAt(i);	
		//10 - end		
		//47-57 - numeric(0-9)			
		//96-123 - small letter
		if(ascCode==10 || ascCode>47 && ascCode<58)
		{	
			isError=false; 
		}
		else
		{
			isError=true;
		}		
		if(isError==true) 
		break;
	}
	if (isError==true) 
	{
		return false;
	}
	else
	{
		return true;
	}
}
/* 
Function to check valid ZIP : requires object as parameter
Logic:
Length should be greater than or equal to 5 and less than or equal to 10
Only Numeric value is permissible
*/
function IsZip(ParamTxtobj)
{
	var makename=ParamTxtobj;
	var ascCode,i,strRet;
	var isError,makenameval;
	makenameval=makename.value.toLowerCase();
	strRet="";
	isError=false; 
	if((makenameval.length<=5)&&(makenameval.length>=10))
	{
		isError=true;
	}
	if(isError==false)
	{
		for(i=0;i<makenameval.length;i++)
		{   
			ascCode=makenameval.charCodeAt(i);			
			//10 - end			
			//47-57 - numeric(0-9)		
			if(ascCode==10 || ascCode>47 && ascCode<58 ||(ascCode>96 && ascCode<123 ))
			{	
				isError=false; 
			}
			else
			{
				isError=true;
			}		
			if (isError==true) 
			break;
			
		}
	}	
	if (isError==true) 
	{
		return false;
	}
	else
	{
		return true;
	}
}		
/* 
Function to check valid Phone : requires object as parameter
Logic:
Length should be greater than or equal to 10 and less than or equal to 15
Only Numeric value is permissible
*/
function IsPhone(ParamTxtobj)
{
	var makename=ParamTxtobj;
	var ascCode,i,strRet;
	var isError,makenameval;
	makenameval=makename.value.toLowerCase();
	strRet="";
	isError=false; 
	if((makenameval.length<=10)&&(makenameval.length>=15))
	{
		isError=true;
	}
	if(isError==false)
	{
		for(i=0;i<makenameval.length;i++)
		{   
			ascCode=makenameval.charCodeAt(i);
			//10 - end
			//47-57 - numeric(0-9)		
			//alert(ascCode);	
			if(ascCode==10 || ascCode==40 ||ascCode==41 || ascCode>47 && ascCode<58 )
			{	
				isError=false; 
			}
			else
			{
				isError=true;
			}		
			if (isError==true) 
			break;			
		}
	}	
	if (isError==true) 
	{
		return false;
	}
	else
	{
		return true;
	}
}	
/* 
Function to check valid POP3 port : requires object as parameter
Logic:
Length should be greater than or equal to 1 and less than or equal to 3
Only Numeric value is permissible
*/
function IsPOP3(ParamTxtobj)
{
	var makename=ParamTxtobj;
	var ascCode,i,strRet;
	var isError,makenameval;
	makenameval=makename.value.toLowerCase();
	strRet="";
	isError=false; 
	if((makenameval.length<=1)&&(makenameval.length>=3))
	{
		isError=true;
	}
	if(makenameval==0)
	{
		isError=true;
	}
	if(isError==false)
	{
		for(i=0;i<makenameval.length;i++)
		{   
			ascCode=makenameval.charCodeAt(i);
			//10 - end
			//47-57 - numeric(0-9)			
			if(ascCode==10 || ascCode>47 && ascCode<58 )
			{	
				isError=false; 
			}
			else
			{
				isError=true;
			}		
			if (isError==true) 
			break;
			
		}
	}	
	if (isError==true) 
	{
		return false;
	}
	else
	{
		return true;
	}
}	
/* 
Function to check valid SMTP port : requires object as parameter
Logic:
Length should be greater than or equal to 1 and less than or equal to 2
Only Numeric value is permissible
*/
function IsSMTP(ParamTxtobj)
{
	var makename=ParamTxtobj;
	var ascCode,i,strRet;
	var isError,makenameval;
	makenameval=makename.value.toLowerCase();
	strRet="";
	isError=false; 
	if((makenameval.length<=1)&&(makenameval.length>=2))
	{
		isError=true;
	}
	if(makenameval==0)
	{
		isError=true;
	}
	if(isError==false)
	{
		for(i=0;i<makenameval.length;i++)
		{   
			ascCode=makenameval.charCodeAt(i);
			//10 - end
			//47-57 - numeric(0-9)			
			if(ascCode==10 || ascCode>47 && ascCode<58 )
			{	
				isError=false; 
			}
			else
			{
				isError=true;
			}		
			if (isError==true) 
			break;
			
		}
	}	
	if (isError==true) 
	{
		return false;
	}
	else
	{
		return true;
	}
}	
/* Last Update: 20/05/01   */
// func isblank()parameter is string to be compared. returns true if it does not contain any 
// non-whitespace character
function isblank(strval)
{
   if (typeof(strval) == "object")
   {  objtrim(strval);
	  str = strval.value;
   }
   else
   { 
    str = strtrim(strval); 
   }

   var len = str.length;
   for (var i = 0; i < len; i++)
   {
      if (str.charAt(i) != " ")
      {
	     return false;				// If there is any non-space character, isblank() returns false
      }
   }
   return true;
}

// Alltrim function meant only for string value. Returns trimmed value
// Last Modify : 28/05/01
function strtrim(val)
{
   while('' + val.charAt(0)==' ')
   {
      val = val.substring(1,val.length);
   }

   while('' + val.charAt(val.length-1)==' ')
   {
      val = val.substring(0,val.length-1)
   }

   return val;
}

// Alltrim func when object is passed. 
// last Modify : 28/05/01
function objtrim(box)
{
   while('' + box.value.charAt(0)==' ')
   {
      box.value = box.value.substring(1,box.value.length);
   }

   while(''+box.value.charAt(box.value.length-1)==' ')
   {
      box.value = box.value.substring(0,box.value.length-1)
   }

}

// Function to return false if there are any single quotes in 
function noquotes(str)
{
   for (var i=0; i < str.length ; i++ )
   {
      if (str.charAt(i) == "'")
      {
	     return false;				// If the is any non-space character, isblank() returns false
      }
   }
   return true;
}
//Function to validate date.
//Input parameter : textbox control
function ScanDate(ParamTxtobj)
    {
    	
		var vartxt1;
		vartxt1=ParamTxtobj;	
		
		
		//DATE SHOULD BE OF MAX 10 CHARACTERS
		if(vartxt1.length > 10 || vartxt1.length < 8)
		{
			 alert("Enter a valid date,date should be in 'MM/DD/YYYY' format");
			 return false;	
		}
		else 
		{
		
			var vdate,vs1,vmonth,vs2,vyear;
			var fsindex1,fsindex2,leapyear;
			
			fsindex1=vartxt1.indexOf('/') //GETTING INDEX OF 1 ST OCCURENCE OF "/"
			fsindex2=vartxt1.lastIndexOf('/')//GETTING INDEX OF 2ND OCCURENCE OF "/"
			
			vmonth=vartxt1.substring(0,fsindex1);
			vdate=vartxt1.substring(fsindex1+1,fsindex2);
			vyear=vartxt1.substring(fsindex2+1,vartxt1.length);		
			
			
			if(vyear %4==0)
			{
			    leapyear='true';			
			}
			
			if(vyear %100==0)
			{
			    if(vyear %400==0)
			    {
			        leapyear='true';
			    }
			    else
			    {
			        leapyear='false';
			    }
			    
			}			
			
			if(isNaN(vdate) ||isNaN(vmonth)|| isNaN(vyear))
			{
			    alert(" Please eneter date in 'MM/DD/YYYY' format");
				return false;
			
			}
			//MONTH CAN'T BE LESS THAN 0 OR GREATER THAN 12
			if(vmonth > 12 || vmonth < 1)
			 {
				 alert("Please enter a valid month. Date shoud be in 'MM/DD/YYYY format' ");
				 return false;
			 }
			 
			 // CHECKING IF DATE IS ENTERED FOR MOTHH OF FEBRYARY
			
			if( vmonth == 2 )
			{
			    if(leapyear=='true')
			    {
			        if(vdate>29 || vdate <1)
				    {
					   alert("Please enter a date between 1 to 29.");
					    return false;
				    }
			    
			    }
			    else
			    {
			        if(vdate>28 || vdate <1)
				    {
					    alert("Please enter a date between 1 to 28.");
					    return false;
				    }
			    
			    }
				
			
			}
			
			if(vmonth =="1" || vmonth =="01" || vmonth =="3" || vmonth =="03" || vmonth =="5" || vmonth =="05" || vmonth =="7" || vmonth =="07" || vmonth =="8" || vmonth =="08" || vmonth =="10" || vmonth =="12")
			{
				if(vdate < 01 || vdate > 31)
				{
					alert("Please give a valid date for the entered month");
					return false;
				}
			
			}
			
			else
			{
				if(vdate < 1 || vdate > 30)
				{
					alert("Please give a valid date for the entered month");
					return false;
				}
			
			}
			
		}
		
    	return true;
    }
    
    
//Function to validate Time.
//Input parameter : textbox control
function checkTime(ParamTxtobj)
   {
    	
		var vartxt1;
		vartxt1=ParamTxtobj;
		
		//Time SHOULD BE OF MAX 8 CHARACTERS
		if(vartxt1.length > 8 || vartxt1.length < 6)
		{
			 alert("1. Enter a valid time, Time should be in 'hh:mm am' format");
			 return false;	
		}
		else 
		{
		
			var vAMPM,vs1,vMinute,vs2,vHour;
			var fsindex1,fsindex2;
			
			fsindex1=vartxt1.indexOf(':') //GETTING INDEX OF 1 ST OCCURENCE OF ":"
			fsindex2=vartxt1.indexOf(' ')//GETTING INDEX OF 1st OCCURENCE OF " "
			
			vHour=vartxt1.substring(0,fsindex1);
			//vMinute=vartxt1.substring(fsindex1+1,fsindex2);
			vMinute=vartxt1.substring(fsindex1+1,fsindex1+3);
			vAMPM=vartxt1.substring(vartxt1.length-2,vartxt1.length);
			//vAMPM=vartxt1.substring(fsindex1+4,vartxt1.length);
			//vAMPM=vartxt1.substring(fsindex2+1,vartxt1.length);		
			
			// 
			if(isNaN(vHour) ||isNaN(vMinute))
			{
			    alert("2. Enter a valid time, Time should be in 'hh:mm am' format");
				return false;			
			}
			else if(vAMPM != 'am' && vAMPM != 'AM' && vAMPM != 'pm' && vAMPM != 'PM')
			{
			    alert("3. Enter a valid time, Time should be in 'hh:mm am' format");
				return false;
			}			
			//Check Hour
			if(vHour > 12 || vHour < 1)
			{
				 alert("4. Enter a valid time, Time should be in 'hh:mm am' format");
				 return false;
			}
			 
			 //Check Minute
			if(vMinute > 59 || vMinute < 0)
			{
				 alert("5. Enter a valid time, Time should be in 'hh:mm am' format");
				 return false;
			}
		}
		
    	return true;
    }

