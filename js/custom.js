/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function updateParameter(field, value, parameter) {
    parameter = typeof parameter !== 'undefined' ? parameter : "";
    var result = "",
        tmp = [],
        isFound = false;
    var items = [];
    if(parameter == "")
        items = location.search.substr(1).split("&");
    else
        items = parameter.split("&");
    for (var index = 0; index < items.length; index++) {
        tmp = items[index].split("=");
        if (tmp[0] === field) {
            result +=tmp[0]+"="+value+"&";
            isFound = true;
            continue;
        }
        else
            result +=tmp[0]+"="+decodeURIComponent(tmp[1])+"&";
    }
    if(!isFound && field != "") result += field+"="+value
    else result = result.substr(0,result.length-1);
    return result;
}

function formatNumber(nStr, thousandSymbol, commaSymbol)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? commaSymbol + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + thousandSymbol + '$2');
	}
	return x1 + x2;
}

function getCurrentDate(){
    var d = new Date();

    var month = d.getMonth()+1;
    var day = d.getDate();

    var output = 
        (month<10 ? '0' : '') + month + '/' +
        (day<10 ? '0' : '') + day + '/' + d.getFullYear();
        return output;
}

function datediff(fromDate,toDate,interval) {
                /*
                 * DateFormat month/day/year hh:mm:ss
                 * ex.
                 * datediff('01/01/2011 12:00:00','01/01/2011 13:30:00','seconds');
                 */
                var second=1000, minute=second*60, hour=minute*60, day=hour*24, week=day*7;
                fromDate = new Date(fromDate);
                toDate = new Date(toDate);
                var timediff = toDate - fromDate;
                if (isNaN(timediff)) return NaN;
                switch (interval) {
                    case "years": return toDate.getFullYear() - fromDate.getFullYear();
                    case "months": return (
                        ( toDate.getFullYear() * 12 + toDate.getMonth() )
                        -
                        ( fromDate.getFullYear() * 12 + fromDate.getMonth() )
                    );
                    case "weeks"  : return Math.floor(timediff / week);
                    case "days"   : return Math.floor(timediff / day); 
                    case "hours"  : return Math.floor(timediff / hour); 
                    case "minutes": return Math.floor(timediff / minute);
                    case "seconds": return Math.floor(timediff / second);
                    default: return undefined;
                }
            }

