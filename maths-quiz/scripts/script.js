// DOM elements
let board = document.querySelector(".board");
let fields = document.querySelectorAll(".field");
let field1 = document.querySelector(".field-1");
let field2 = document.querySelector(".field-2");
let field3 = document.querySelector(".field-3");
let field4 = document.querySelector(".field-4");
let field5 = document.querySelector(".field-5");
let field6 = document.querySelector(".field-6");
let field7 = document.querySelector(".field-7");
let field8 = document.querySelector(".field-8");
let field9 = document.querySelector(".field-9");

let mathsQuestion = document.querySelector(".maths-question");
let playerInput = document.querySelector("#player-input");

let makeMoveBtn = document.querySelector(".make-move-btn");
let newGameBtn = document.querySelector(".new-game-btn");

// Event listeners
// Field 1: on click: 
  // generate random ints a, b
  // call add(a, b)

// The quiz
function MathsQuiz() {
  this.level = 1;
  this.a;
  this.b;
  this.result;
  this.userInput;
  this.calculationString;
  this.add = function() {
    // generate random ints a and b
    this.calculationString = /*`a` `calculation type` `b` */
    this.displayCalculation();
    // Get actual result of calculation
    this.result = a + b;
    // check against user input
    this.evaluateUserInput();
    this.checkLevel();
  }
  // rest of calculation methods
  
  this.generateRandomInt = function() {}
  
  this.displayCalculation = function() {}
  
  this.getUserInput = function() {
    // turn into number type
  }
  this.displayCalculation = function() {}
  this.evaluateUserInput = function() {
    this.userInput = this.getUserInput();
    if (this.userInput === this.result) {
      this.level++;
    }
  }

  this.checkLevel = function() {
    if (this.level >= 9) {
      // Announce winner
      return; // End game, disable "make move" button
    }
  }
}