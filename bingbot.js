// ==UserScript==
// @name         bingBot
// @namespace    http://tampermonkey.net/
// @version      0.1
// @description  try to take over the world!
// @author       Pleschenkov Danila
// @match        https://www.bing.com/*
// @match        https://napli.ru/*
// @icon         data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==
// @grant        none
// ==/UserScript==


let keywords = ["как использовать devtools браузера", "10 популярных шрифтов от Google", "редакций и ревизий в вордпресс", "Вывод произвольных типов записей"];
let keyword = keywords[getRandom(0, keywords.length)];
let links = document.links;
let search = document.getElementsByClassName("search")[0];
let bingInput = document.getElementsByClassName("sb_form_q")[0];
let nextClick = document.getElementsByClassName("sb_pagN")[0];

if (search !== undefined) {
    // Работаем на главной
    let i = 0;
    let timerId = setInterval(() => {
        bingInput.value += keyword[i];
        i++
        if (i == keyword.length) {
            clearInterval(timerId)
            search.click();
        }
    }, 500)
    } else if (location.hostname == "napli.ru") {
        //работаем на целевом сайте
        console.log("Мы на целевом сайте");
        setInterval(() => {
            let index = getRandom(0, links.length);
            // с долей вероятности 30% уйдем обратно в поисковик
            if (getRandom(0, 101) >= 70) {
                location.href = "https://www.bing.com/";
            }
            // Перебираем ссылки и проверяем, что по ним можно кликнуть
            if (links[index].href.indexOf("napli.ru") != -1) links[index].click();
        }, getRandom(2000,5000))
    } else {
        let nextBingPage = true;
        //рабтаем в поисковой выдаче
        for(let i = 0; i < links.length; i++) {
            if (links[i].href.indexOf("napli.ru") != -1) {
                let link = links[i];
                nextBingPage = false;
                console.log("Нашел строку " + link);
                link.removeAttribute("target");
                setTimeout(() => {
                    link.click();
                }, getRandom(2500, 5000))
                break;
            }
        }
        //Если не нашли на первой странице выдачи
        let elementExist = setInterval(() => {
            let element = document.querySelector(".sb_pagS");
            if (element != null) {
                if (element.innerText == "5") {
                    nextBingPage = false;
                    location.href = "https://www.bing.com/";
                }
                clearInterval(elementExist);
            }
        }, 100)
        if (nextBingPage) {
            setTimeout(() => {
                nextClick.click();
            }, getRandom(3000,8000))
        }
    }

    function getRandom(min, max) {
        return Math.floor(Math.random() * (max - min) + min)
    }
