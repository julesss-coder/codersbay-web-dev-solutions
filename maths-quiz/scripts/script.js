// DOM elements
let board = document.querySelector(".board");
let fields = document.querySelectorAll(".field"); // NodeList
// let field1 = document.querySelector(".field-1");
// let field2 = document.querySelector(".field-2");
// let field3 = document.querySelector(".field-3");
// let field4 = document.querySelector(".field-4");
// let field5 = document.querySelector(".field-5");
// let field6 = document.querySelector(".field-6");
// let field7 = document.querySelector(".field-7");
// let field8 = document.querySelector(".field-8");
// let field9 = document.querySelector(".field-9");


let playerInputField = document.querySelector(".player-input-field");
let questionAnswer = document.querySelector(".question-answer");
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
    this.displayCalculation();
    this.result = this.a + this.b;
    this.checkLevel();
  }

  subtract() {
    this.a = this.generateRandomInt();
    this.b = this.generateRandomInt();
    this.calculationString = `${this.a} - ${this.b} = ?`;
    this.displayCalculation();
    this.result = this.a - this.b;
    this.checkLevel();
  }

  multiply() {
    this.a = this.generateRandomInt();
    this.b = this.generateRandomInt();
    this.calculationString = `${this.a} * ${this.b} = ?`;
    this.displayCalculation();
    this.result = this.a * this.b;
    this.checkLevel();
  }

  divide() {
    this.a = this.generateRandomInt();
    this.b = this.generateRandomInt();
    this.calculationString = `${this.a} ÷ ${this.b} = ?`;
    this.displayCalculation();
    this.result = +(this.a / this.b).toFixed(3);
    this.checkLevel();
  }

  square() {
    this.a = this.generateRandomInt();
    this.calculationString = `${this.a}² = ?`;
    this.displayCalculation();
    this.result = Math.pow(this.a, 2);
    this.checkLevel();
  }

  cube() {
    this.a = this.generateRandomInt();
    this.calculationString = `${this.a}³ = ?`;
    this.displayCalculation();
    this.result = Math.pow(this.a, 3);
    this.checkLevel();
  }

  getPercentage() {
    this.a = this.generateRandomInt();
    this.b = this.generateRandomInt();
    this.calculationString = `${this.a}% * ${this.b} = ?`;
    this.displayCalculation();
    this.result = +((this.a)/100 * this.b).toFixed(3);
    this.checkLevel();
  }

  getSquareRoot() {
    this.a = this.generateRandomInt();
    this.calculationString = `\u221A${this.a}`;
    this.displayCalculation();
    this.result = +(Math.sqrt(this.a)).toFixed(3);
    this.checkLevel();
  }

  getCubeRoot() {
    this.a = this.generateRandomInt();
    this.calculationString = `\u221B${this.a}`; 
    this.displayCalculation();
    this.result = +(Math.cbrt(this.a)).toFixed(3);
    this.checkLevel();
  }

  generateRandomInt() {
    return Math.ceil(Math.random() * 51);
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
      let playerInput = +this.playerInput;
      return +playerInput.toFixed(3);
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
    if (this.level > 9) {
      announcement.textContent = "You have successfully completed all levels. Congratulations!";
      makeMoveBtn.disabled = true;
      return; // End game
    }
  }
  
  markCurrentLevel() {
    // get the field in fields for the current level:
      // if level is 1, get field at index level - 1
    if (this.level < 10) {
      let currentField = fields[this.level - 1];
      // FIXME
      if (this.level > 1) {
        let previousField = fields[this.level - 2];
        previousField.classList.remove("current-level");
      }
      if (!currentField.classList.contains("current-field")) {
        currentField.classList.add("current-level");
      }
    }
  }


}

// Quiz instance
let newQuiz = new MathsQuiz();

// Event listeners
  
makeMoveBtn.addEventListener("click", function() {
  playerInput.focus(); // FIXME Why can't I add focus to input field?
  newQuiz.markCurrentLevel(); // adapt function for level 1 - there is no previous level
  announcement.textContent = "";
  mathsQuestion.textContent = "";
  newQuiz.askMathsQuestionForLevel();
});

// Input field:
submitBtn.addEventListener("click", function(event) {
  console.log(playerInput.textContent.trim());
  if (playerInput.value.trim() !== "") {
    newQuiz.evaluatePlayerInput();
    newQuiz.checkLevel();
  }
});

// add `hide` logic here too
playerInput.addEventListener("keyup", function(event) {
  if (event.key === "Enter" && playerInput.value.trim() !== "") {
    console.log("event.target.value: ", event.target.value);
    newQuiz.evaluatePlayerInput();
    newQuiz.checkLevel();
  }
});

newGameBtn.addEventListener("click", function() {
  mathsQuestion.textContent = "";
  announcement.textContent = "";
  playerInputField.classList.add("hide");

  fields.forEach((field) => {
    field.classList.remove("current-level");
  });
  newQuiz = new MathsQuiz(); // is the previous instance deleted? Does the garbage collector do that?
});



// Use jQuery to traverse the DOM

// Board changes display to 2 columns under 850px!!!
// Find better way of hiding and displaying input field
  // Currently, .hide is toggled every time player clicks "make move" (even when they don't enter a solution)
