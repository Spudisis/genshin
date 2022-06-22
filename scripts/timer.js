//timer
let timerID;
const dayCount = document.querySelector('#day');
const hourCount = document.querySelector("#hour");
const minCount = document.querySelector('#min');
const secCount = document.querySelector('#sec');


const startfunc = function (testday, testhour, testminute, testsec) {

    let sec = testsec;
    let min = testminute;
    let hour = testhour;
    let day = testday;


    timerID = setInterval(function () {
        if (sec == 0 && min == 0 && hour == 0 && day == 0) {

            secondTime();
            count++;
        }
        if (sec < 0 && min != 0) {
            sec = 59;
            min--;
        }
        if (sec < 0 && min == 0 && hour != 0) {
            min = 59;
            sec = 59;
            hour--;
        }
        if (sec < 0 && min == 0 && hour == 0 && day != 0) {
            min = 59;
            sec = 59;
            hour = 23;
            day--;
        }
        if (0 <= sec && sec <= 9) {
            secCount.innerText = "0" + sec;
            sec--;
        }
        else {
            secCount.innerText = sec;
            sec--;
        }


        if (min <= 9) {
            minCount.innerText = "0" + min + ":";

        }
        else {
            minCount.innerText = min + ":";
        }
        if (hour <= 9) {
            hourCount.innerText = "0" + hour + ":";
        }
        else {
            hourCount.innerText = hour + ":";
        }

        if (day <= 9) {
            dayCount.innerText = "0" + day + ":";
        }
        else {
            dayCount.innerText = day + ":";
        }
    }, 1000)


};
let count = 0;
let v = new Date(2022, 5, 20, 20, 0);
const secondTime = function () {
    clearInterval(timerID);
    let test = new Date();

    let minus = v - test;
    let testday = Math.trunc(minus / 1000 / 60 / 60 / 24);
    let testhour = Math.trunc(minus / 1000 / 60 / 60 - testday * 24);
    let testminute = Math.trunc((minus / 1000 / 60 - Math.trunc(minus / 1000 / 60 / 60) * 60));
    let testsec = Math.trunc(minus / 1000 - Math.trunc(minus / 1000 / 60) * 60);
    if (count > 1) {
        v.setHours(v.getHours() + 10);
        count = 0;
    }
    else {
        v.setDate(v.getDate() + 21);
        count++;
    }
    startfunc(testday, testhour, testminute, testsec);

}
secondTime();
const StopTimerFunc = function () {
    clearInterval(timerID);

}










//аниации для кнопок переходов на другие стр
let general = document.getElementById('helpingWeap');
let h2 = document.getElementById('name_href_weap');
let weapon = document.getElementById('img_weap');
let start = Date.now();

if (general) {
    general.addEventListener('mouseenter', () => {
        weapon.style.opacity = "1";
        // start = Date.now();
        // let move = setInterval(function(){
        //     let timePassed = Date.now() - start;
        //         if (timePassed >= 1000) {
        //           clearInterval(move); 
        //           return;
        //         }   
        //         draw(timePassed);               
        // }, 10);
        // function draw(timePassed) {
        //     h2.style.top = 20 + timePassed / 20 +  'px';  
        // }
    })
    general.addEventListener('mouseleave', () => {

        h2.style.top = "15%";
        weapon.style.opacity = "0.5";
    })

}
else {
    console.log('ewrher');
}


