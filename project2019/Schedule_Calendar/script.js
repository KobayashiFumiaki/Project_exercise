//1月～12月のそれぞれの月に何日あるかを、monthdays配列に設定
var monthdays = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
//曜日表示を配列で設定
var days = new Array("日", "月", "火", "水", "木", "金", "土");
        
//祝日1：何月の何日目であるかを設定
var Holidays1 = new Array(1,1, 2,11, 3,21, 4,29, 5,3, 5,4, 5,5, 9,23, 11,3, 11,23, 12,23);
//祝日2：何月の第何月曜日であるかを設定
var Holidays2 = new Array(1,2, 7,3, 9,3, 10,2);
        
//現在の日時nowかthisYear、thisMonth、today を設定
var now = new Date();
var thisYear = now.getFullYear(this);


var thisMonth = now.getMonth() + 1;
var today = now.getDate();
            
//表示年月を記憶
var year = thisYear;
var month = thisMonth;
       

//showCalen関数
//仕様: getElementById()で、特定のタグにアクセスし、そのinnerHTMLプロパティの値を書き換えて「前月」や「次月」のカレンダーを表示する
//最初に引数'0'で呼び出し今月を表示。その後、'1'または、'-1'を引数とする( (1 → 次月), (-1 → 前月) )
function showCalen(n) {
    //引数nでmonthの増減を行い、monthの値が1～12の範囲を超えた場合には、yearとmonthを設定し直す
    month += n;
    if(month == 0){
        year--; 
        month=12;
    }else if(month == 13){
        year++;
        month = 1; 
    }
    //flag: 表示年月が今月ならば'1'、そうでなければ'0'に設定しておく(flag制御に使用する)
    var flag = (year == thisYear && month == thisMonth)? 1: 0;
    //新しく設定されたyear、monthを使い、表示月の1日のDateオブジェクトを作成し、このオブジェクトのgetDay()メソッドを使用して、1日の曜日をstartDayに設定する 
    var date = new Date(year, month-1, 1); //表示月の1日のDate()
    var startDay = date.getDay();
    //表示月が何日あるかをdateMaxに設定しています。
    var dateMax = monthdays[month - 1];
    if(month == 2 && ( (year%4 == 0 && year%100 != 0) || (year%400 == 0) )){
        dateMax = 29;
    }
    //祝日の処理
    //holiday: 今月の祝日を格納する配列
    var holidays = new Array();　//休日配列の初期化
    for(var i=0; i<=dateMax; i++){
        holidays[i] = 0;
    }
            
    //祝日1の処理
    var firstSunday = (startDay == 0) ? 1: 8 - startDay;
    for(i=0; i<Holidays1.length; i+=2){
        if(Holidays1[i] == month){
            holidays[Holidays1[i+1]] = 1;
            for(var j=firstSunday; j<dateMax; j+=7){
                if(Holidays1[i+1] == j ){
                    holidays[j+1] = 1;
                    break; //振替休日
                }
            }
        }
    }
            
    //祝日2の処理
    var mondays = new Array();
    var firstMonday = (startDay < 2) ? 2 - startDay: 9 - startDay;
    for(i=0; i<Holidays2.length; i+=2){
        if(Holidays2[i] == month){
            holidays[(Holidays2[i+1] - 1) * 7 + firstMonday] = 1;  
        }
    }
         
    // 出力 //
    var htmlStr = "<table class='calen'>\n" + "<tr class='bg1'><th colspan=7>" + year + "年 " + month + "月</th></tr>\n";
    
    console.log(year);
    console.log(month);
    var print = document.getElementById('printYM');
    print.textContent = year + "年  " + month + "月";
    
    htmlStr += "<tr class='bg2'><th class='sun'>" + days[0] + "</th>";
    for(i=1; i<6; i++){
        htmlStr += "<th>" + days[i] + "</th>";
    }
    htmlStr += "<th class='sat'>" + days[6] + "</th></tr>\n";
            
    var col = 0;
    if(startDay > 0){
        htmlStr = htmlStr + "<tr>";
        for(col=0; col<startDay; col++){
            htmlStr += "<td>&nbsp;</td>";
        }
    }
            
    for(i=1; i<=dateMax; i++){
        if(col == 0){
            htmlStr += "<tr>";
        }
                
        if(flag == 1 && i == today){
            if(holidays[i] == 1 || col == 0){
                htmlStr += "<td class='today sun'><button id='"+i+"' onclick='DayBtn(this)'>";
            }else if(col == 6){
                htmlStr += "<td class='today sat'><button id='"+i+"' onclick='DayBtn(this)'>";
            }else{
                htmlStr += "<td class='today'><button id='"+i+"' onclick='DayBtn(this)'>";
            } 
        }else if(holidays[i] == 1 || col == 0){
                htmlStr += "<td class='sun'><button id='"+i+"' onclick='DayBtn(this)'>";
        }else if(col == 6){
                htmlStr += "<td class='sat'><button id='"+i+"' onclick='DayBtn(this)'>";
        }else{
                htmlStr += "<td><button id='"+i+"' onclick='DayBtn(this)'>";
        } 
    
        htmlStr += i + "</button></td>";
        if(col == 6){ 
            htmlStr += "</tr>\n"; 
            col=0; 
        }else{
            col++;
        }
    }
         
    if(col != 0){
        for(cpl=0; col < 7; col++){
            htmlStr += "<td>&nbsp;</td>";      
        } 
        htmlStr += "</tr>";
    }
    
    htmlStr += "</table>";
    document.getElementById("calen").innerHTML = htmlStr; 
}

//カレンダーの押されたボタンを表示させる
function DayBtn(obj){
    var printday = document.getElementById('outputday');
    printday.textContent = obj.id + ' 日の予定登録';
    console.log(obj);
}
   
   