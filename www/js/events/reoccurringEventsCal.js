// set up variables
var monthsArray = new Array("January","February","March","April","May","June","July","August","September","October","November","December");
var daysArray = new Array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
var prevYears = 10;	// number of years before current date
var futureYears = 10;	// number of years after current date
var today = new Date();
var nowMonth = today.getMonth();
var nowYear = today.getFullYear();
var curMonth = nowMonth;
var curYear = nowYear;
var monthEvents;
today.setDate(1);	// set to first day of the month

var eventsArray = new Array();
// format: dd,mm,yyyy,"event","frequency (Annual/Monthly/Weekly)" - Delete frequency for once-time occurrences
eventsArray[0] = new newEvent(25,12,2006,"Christmas Day","Annual");
eventsArray[1] = new newEvent(30,7,2006,"My Birthday","Annual");
//eventsArray[2] = new newEvent(1,1,2006,"First","Monthly");
//eventsArray[3] = new newEvent(2,12,2006,"Weekly","Weekly");
eventsArray[2] = new newEvent(24,12,2006,"Christmas Eve","Annual");
eventsArray[3] = new newEvent(15,3,2007,"Physical Check-Up","Annual");
eventsArray[4] = new newEvent(12,3,2007,"Meeting");

// create event object
function newEvent(day, month, year, memo, occurrence) {
    this.day = day;
    this.month = month;
    this.year = year;
    this.memo = memo;
    this.occurrence = occurrence;
    this.createMonth = createMonth;
}


// creates calendar for the current month
function createMonth() {
    var startDay = today.getDay();	// first day of the month
    var monLength = monthLength();	// number of days in month
    var lastDay = startDay+monLength-1;	// last day of the month
    monthEvents = new Array();	// array to hold events for current month

    // search through events for current month
    for(i=0;i<eventsArray.length;i++) {
	if(eventsArray[i].month == (curMonth+1) && (eventsArray[i].year == curYear || eventsArray[i].occurrence == "Annual")) {
	    monthEvents[monthEvents.length] = i;
	}
	else if(eventsArray[i].occurrence == "Monthly" || eventsArray[i].occurrence == "Weekly") {
	    monthEvents[monthEvents.length] = i;
	}
    }
    
    var content = "<table class=\"calendar\" cellspacing=\"0\">\n";
    // create headers
    content += "<tr>\n<th><a class=\"button\" href=\"javascript:void(prev())\">Back</a></th>\n";
    content += "<th colspan=\"5\">" + monthsArray[curMonth] + " " + curYear + "</th>\n";
    content += "<th><a class=\"button\" href=\"javascript:void(next())\">Next</a></th>\n</tr><tr>\n";
    for(i=0;i<7;i++) {
	content += "<th>" + daysArray[i] + "</th>\n";
    }
    content += "</tr>\n<tr>\n";

    // create main content of calendar
    for(i=0;i<42;i++) {
	var occ = "";
	var occContent = "";
	var curDay = i+1-startDay;
	var fullContent = "d";
	// check day against months events
	for(j=0;j<monthEvents.length;j++) {
	    var occDate = new Date();
	    occDate.setDate(eventsArray[monthEvents[j]].day);
	    occDate.setMonth(eventsArray[monthEvents[j]].month);
	    occDate.setFullYear(eventsArray[monthEvents[j]].year);
	    
	    if(curDay == eventsArray[monthEvents[j]].day && eventsArray[monthEvents[j]].occurrence != "Weekly") {// deal with day, monthly and annual events
		occ = " class=\"occassion\"";
		fullContent = "d";//eventsArray[monthEvents[j]].memo;
		if(eventsArray[monthEvents[j]].memo.length > 14) {
		    occContent = fullContent.substr(0,13) + "...";
		    break;
		}
		else {
		    occContent = fullContent;
		    break;
		}
	    }
	    else if(occDate.getDate() == (i%7) && eventsArray[monthEvents[j]].occurrence == "Weekly") {	// deal with weekly events
		occ = " class=\"occassion\"";
		fullContent = "d";//eventsArray[monthEvents[j]].memo;
		if(eventsArray[monthEvents[j]].memo.length > 14) {
		    occContent = fullContent.substr(0,13) + "...";
		    break;
		}
		else {
		    occContent = fullContent;
		    break;
		}
	    }
	    else
		fullContent = "d";
	}
	if(i>lastDay && i==35) {	// do not show last row if not needed
	    break;
	}
	if(i<startDay || i>lastDay) {	// show blank cells before and after month
	    content += "<td class=\"blank\">&nbsp;</td>\n";
	}
	else {
	    if(!(i%7) || !((i+1)%7) ) {	// get days of the weekend
		if(!(i%7)&& i>0) {
		    content += "</tr>\n<tr>\n";
		}
		content += "<td style=\"cursor:pointer\" onclick=\"choosenday("+curDay+", "+curMonth+")\" " + occ + "><span class=\"weekend\">"
		    + curDay+"</span><br /></td>";
	    }
	    else {
		content += "<td style=\"cursor:pointer\" onclick=\"choosenday("+curDay+", "+curMonth+")\" " + occ + " id=\"days\">"+curDay+"</td>\n";
	    }
	}
    }
    content += "</tr></table>\n";

    return content;
}
function choosenday(day, month) {
    var date = day + "-" + (month+1) + "-" + curYear;
    document.write("<form id=\"sampleForm\" name=\"sampleForm\" method=\"post\" action=\"today.php\"><input type=\"hidden\" name=\"total\" id=\"day\" value="+date+"></form>");
    document.forms["sampleForm"].submit();  
}

// get length of month
function monthLength()  {
	monLength = 31;
	if(curMonth == 3 || curMonth == 5 || curMonth == 8 || curMonth == 10) monLength = 30;
	if(curMonth == 1) {
		if(curYear%4) {
			monLength = 28;
		}
		else {
			monLength = 29;
		}
	}
	return monLength;
}

function droplists() {
    content = "<form name=\"calNav\" method=\"post\" action=\"\">\n";
    content += "<select name=\"month\">\n";
    for(i=0;i<12;i++) {
	content += "<option value=\""+i +"\"";
	if(i == curMonth) {
	    content += " selected=\"selected\"";
	}
	content += ">" + monthsArray[i] + "</option>\n";
    }
    content += "</select> <select name=\"year\">\n";
    for(i=(nowYear-prevYears);i<=(nowYear+futureYears);i++) {
	content += "<option value=\""+i +"\"";
	if(i == curYear) {
	    content += " selected=\"selected\"";
	}
	content += ">" + i + "</option>\n";
    }
    content += "</select>\n<input type=\"button\" value=\"Go\" onclick=\"newMonth()\" />\n";
    content += "</form>\n";
    return content;
}

function newMonth() {
	var mon = document.calNav.month.selectedIndex;
	curMonth = parseInt(document.calNav.month.options[mon].value);
	var yr = document.calNav.year.selectedIndex;
	curYear = parseInt(document.calNav.year.options[yr].value);
	today.setMonth(curMonth);
	today.setFullYear(curYear);
	document.getElementById("calendar").innerHTML = droplists() + createMonth();
}

// goto previous month
function prev() {
	curMonth -= 1;
	if(curMonth<0) {
		curMonth=11;
		if(curYear>(nowYear-prevYears)) {
			curYear -= 1;
		}
	}
	today.setMonth(curMonth);
	today.setFullYear(curYear);
	document.getElementById("calendar").innerHTML = droplists() + createMonth();
}

// goto next month
function next() {
	curMonth += 1;
	if(curMonth>11) {
		curMonth=0;
		if(curYear<(nowYear+futureYears)) {
			curYear += 1;
		}
	}
	today.setMonth(curMonth);
	today.setFullYear(curYear);
	document.getElementById("calendar").innerHTML = droplists() + createMonth();
}