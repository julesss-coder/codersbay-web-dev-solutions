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


let playerInputField = document.querySelector(".player-input-field");
let mathsQuestion = document.querySelector(".maths-question");
let playerInput = document.querySelector("#player-input");
let submitBtn = document.querySelector("#submit-btn");
let announcement = document.querySelector(".announcement");

let makeMoveBtn = document.querySelector(".make-move-btn");
let newGameBtn = document.querySelector(".new-game-btn");

// The quiz
// Could be a regular function, as we only ever use one instance of the game at a time
// Better to use ES6, as JS keeps developing and older versions of JS may cause errors
class MathsQuiz {

  constructor() {
    // Reset for each new question
    this.level = 1;
    this.a;
    this.b;
    this.result;
    this.playerInput;
    this.calculationString;
  }

  // get correct calculation
  // get quiz question for level
  askMathsQuestionForLevel() {
    switch (this.level) {
      case 1: this.add();
      break;
      case 2: this.subtract();
      break;
      case 3: this.multiply();
      break;
      case 4: this.divide();
      break;
      case 5: this.square();
      break;
      case 6: this.cube();
      break;
      case 7: this.getPercentage();
      break;
      case 8: this.getSquareRoot();
      break;
      case 9: this.getCubeRoot();
      break;
      default: alert("Something went wrong.");
    }
  }

  // Brauche ich `this`, um in der Klasse auf Methoden zuzugreifen?
  add() {
    this.a = this.generateRandomInt();
    this.b = this.generateRandomInt();
    this.calculationString = `${this.a} + ${this.b} = ?`;
    console.log("calculation string: ", this.calculationString);
    this.displayCalculation();
    // Get actual result of calculation
    this.result = this.a + this.b;
    
    this.checkLevel();
  }
  // rest of calculation methods
  
  generateRandomInt() {
    return Math.round(Math.random() * 101);
  }
  
  displayCalculation() {
    mathsQuestion.textContent = this.calculationString;
  }
  
  getPlayerInput() {
    // Input field is type="number" -> no need to check for strings
    this.playerInput = playerInput.value.trim();
    if (this.playerInput === "") {
      playerInput.classList.toggle("invalid-input");
      return; // What happens afterwards?
    } else {
      return +playerInput.value
    }
  }

  evaluatePlayerInput() {
    this.playerInput = this.getPlayerInput();
    // How to make sure question etc is not displayed when there is no player input?
    if (this.playerInput === this.result) {
      this.level++;
      this.markCurrentLevel();
      announcement.innerText = `Question: ${this.calculationString}
      Your answer: ${this.playerInput}
      Correct solution: ${this.result}. 
      Your answer is correct!`;
    } else {
      announcement.innerText = `Question: ${this.calculationString}
      Your answer: ${this.playerInput}
      Solution: ${this.result}. 
      Your answer is not correct.`;
    }
    mathsQuestion.textContent = "";
    playerInput.value = "";
  }

  checkLevel() {
    if (this.level >= 9) {
      announcement.textContent = "You have successfully completed all levels. Congratulations!";
      makeMoveBtn.disabled = true;
      return; // End game
    }
  }

  markCurrentLevel() {
    let currentField = `field${this.level}`;
    let previousField = `field${this.level - 1}`;
    // FIXME
    // if (this.level > 1) {
    //   currentField.classList.toggle("current-level");
    // }
    // previousField.classList.toggle("current-level");
  }
}

// Quiz instance
let newQuiz = new MathsQuiz();

// Event listeners
// Field 1: on click: 
  // generate random ints a, b
  // call add(a, b)

// "Make move" button
/*
===========CONTINUE HERE=========
On click:
  mark current level // where else am I doing this, and is it necessary?
  askMathsQuestionForLevel() 
  
*/
makeMoveBtn.addEventListener("click", function() {
  newQuiz.markCurrentLevel(); // adapt function for level 1 - there is no previous level
  newQuiz.askMathsQuestionForLevel();
  playerInputField.classList.toggle("hide");
})

// Input field:
// Should I have access to class instance here?
// If the game were a set of regular functions, I would call the appropriate one from the event listener, too.
// On hitting enter AND on hitting submit
submitBtn.addEventListener("click", function(event) {
  newQuiz.evaluatePlayerInput();
  newQuiz.checkLevel();
  playerInputField.classList.toggle("hide");
});

playerInput.addEventListener("keyup", function(event) {
  if (event.key === "Enter") {
    console.log("event.target.value: ", event.target.value);
    newQuiz.evaluatePlayerInput();
    newQuiz.checkLevel();
    playerInputField.classList.toggle("hide");
  }
});



// Use jQuery to traverse the DOM
