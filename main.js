//init function
window.addEventListener('load',init);

//global variables

//Available Levels
const levels = {
    easy: 5,
    medium: 3,
    hard: 2
}

//to change level
let currentLevel = levels.easy;

let time=currentLevel;
let score=0;
let isPlaying;

//dom elements
const wordInput = document.querySelector('#word-input');
const currentWord = document.querySelector('#current-word');
const scoreDisplay = document.querySelector('#score');
const timeDisplay = document.querySelector('#time');
const message = document.querySelector('#message');
const seconds = document.querySelector('#seconds');
const easy = document.querySelector('#easy');
const medium = document.querySelector('#medium');
const hard = document.querySelector('#hard');

//words array
var words = ["monitor", "program", "application", "keyboard", "javascript", "gaming", "network"];

//Initinalize the Game
function init(){  
    //show seconds in UI
    seconds.innerHTML = currentLevel;
    //select word
    showWord(words);
    //start matching on word input
    wordInput.addEventListener('input',startMatch);
    //call count down every second
    setInterval(countdown,1000);
    //check game status
    setInterval(checkstatus,50);
}

  //event listner for difficulty click
  easy.addEventListener('click',easylevel);
  medium.addEventListener('click',mediumlevel);
  hard.addEventListener('click',hardlevel);

  //function for easylevel selection
  function easylevel(){
    //to change level
    currentLevel = levels.easy;
    //show seconds in UI
    seconds.innerHTML = currentLevel;
  }

  //function for mediumlevel selection
  function mediumlevel(){
      //to change level
    currentLevel = levels.medium;
    //show seconds in UI
    seconds.innerHTML = currentLevel;
}

//function for hardlevel selection
function hardlevel(){
    //to change level
    const currentLevel = levels.hard;
    //show seconds in UI
    seconds.innerHTML = currentLevel;
}

//Start Match
function startMatch(){
    if(matchwords()){
        isPlaying = true;
        time = currentLevel + 1;
        showWord(words);
        wordInput.value = '';
        score++;
    }
    if(score === -1){
        scoreDisplay.innerHTML=0;
    }
    scoreDisplay.innerHTML = score;
}

//comparing the input and question
function matchwords(){
    if(wordInput.value === currentWord.innerHTML){
        message.innerHTML = "Correct !!"
        return true;
    }
    else{
        message.innerHTML = "";
        return false; 
    }
}

//word picker function
function showWord(words){
    //random index generator
    const randIndex = Math.floor(Math.random() * words.length);
    //Output new word
    currentWord.innerHTML=words[randIndex];
}

//countdown timer
function countdown(){
    if(time>0){
        time--;
    }
    else if(time===0){
        //Game over
        isPlaying = false;
    }
    //time Display
    timeDisplay.innerHTML = time;
}

//check game status
function checkstatus(){
    if(!isPlaying && time===0){
        message.innerHTML = 'Game Over'
        score = -1;
    }
}