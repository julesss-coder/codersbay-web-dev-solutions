// DOM elements
let numberOfRounds = document.querySelector(".number-of-rounds");
let currentRound = document.querySelector(".current-round");
let computerChoiceText = document.querySelector(".computer-choice-text");
let computerChoiceImg = document.querySelector(".computer-choice-img");
let userChoiceText = document.querySelector(".user-choice-text");
let userChoiceImg = document.querySelector(".user-choice-img");
let newGameBtn = document.querySelector(".new-game-btn");
let announcements = document.querySelector(".announcements");
let rockBtn = document.querySelector(".rock-btn");
let choiceBtns = document.querySelector(".choice-btns");
let paperBtn = document.querySelector(".paper-btn");
let scissorsBtn = document.querySelector(".scissors-btn");
let userScore = document.querySelector(".user-score");
let computerScore = document.querySelector(".computer-score");
let newGame;


// Event listeners
choiceBtns.addEventListener("click", (event) => {
  if (newGame.rounds > 0) {
    if (event.target.className === "rock-btn" ||
      event.target.className === "paper-btn" ||
      event.target.className === "scissors-btn") {
  
      newGame.userChoice = event.target.textContent;
      newGame.playRound();
      console.log(event.target.textContent);
    }
  }
});

newGameBtn.addEventListener("click", () => {
  newGame = new RockPaperScissors();
  newGame.startGame();  
});


// The game
class RockPaperScissors {
  constructor() {
    this.userScore = 0;
    this.computerScore = 0;
    this.rounds = 0;
    this.choices = ["rock", "paper", "scissors"];
    this.computerChoice = "";
    this.userChoice = "";
    this.roundWinner = "";
  }

  getNumberOfRounds() {
    this.rounds = +prompt("How many rounds would you like to play? Enter an integer.", 1);
    currentRound.textContent = this.rounds;
    numberOfRounds.textContent = this.rounds; // should not change during game bc method is only called in beginning of game
  }

  getComputerChoice() {
    this.computerChoice = this.choices[this.generateRandomNumber()];
  }

  generateRandomNumber() {
    return Math.floor(Math.random() * 3);
  }

  displayChoices() {
    computerChoiceText.textContent = "Computer's choice: " + this.computerChoice;
    userChoiceText.textContent = "User's choice: " + this.userChoice;
    computerChoiceImg.style.backgroundImage = `url(images/${this.computerChoice}.jpg)`;
    userChoiceImg.style.backgroundImage = `url(images/${this.userChoice}.jpg)`;
  }

  displayRounds() {
    currentRound.textContent = this.rounds;
  }

  getRoundWinner() {
    if (this.userChoice === this.computerChoice) {
      this.announceRoundWinner();
    } else {
      if (this.userChoice === "rock") {
        if (this.computerChoice === "paper") {
          this.roundWinner = "computer";
          this.computerScore++;
        } else if (this.computerChoice === "scissors") {
          this.roundWinner = "user";
          this.userScore++;
        }
      } else if (this.userChoice === "paper") {
        if (this.computerChoice === "rock") {
          this.roundWinner = "user";
          this.userScore++;
        } else if (this.computerChoice === "scissors") {
          this.roundWinner = "computer";
          this.computerScore++;
        }
      } else if (this.userChoice === "scissors") {
        if (this.computerChoice === "rock") {
          this.roundWinner = "computer";
          this.computerScore++;
        } else if (this.computerChoice === "paper") {
          this.roundWinner = "user";
          this.userScore++;
        }
      }
      this.displayScore();
      this.announceRoundWinner();
    }
  }

  displayScore() {
    computerScore.textContent = this.computerScore;
    userScore.textContent = this.userScore;
  }

  announceRoundWinner() {
    if (this.roundWinner === "") {
      announcements.textContent = "It's a tie!";
    } else {
      announcements.textContent = `${this.roundWinner.slice(0, 1).toUpperCase() + this.roundWinner.slice(1)} wins the round.`;
    }
  }

  announceFinalWinner() {
    if (this.userScore === this.computerScore) {
      announcements.innerText = 
      `User score: ${this.userScore}, computer score: ${this.computerScore}.
      It's a tie.`;
      return;
    }

    this.userScore > this.computerScore 
      ? 
      announcements.innerText = 
      `User score: ${this.userScore}, computer score: ${this.computerScore}.
      User wins.`
      :
      announcements.innerText = 
      `User score: ${this.userScore}, computer score: ${this.computerScore}
      Computer wins.`;
  }
  
  playRound() {
    if (this.rounds > 0) {
      this.getComputerChoice();
      this.displayChoices();
      this.displayRounds();
      this.getRoundWinner();
      this.rounds--;
      this.displayRounds();
      this.userChoice == "";
      this.computerChoice = "";
      this.roundWinner = "";
    } else {
      return;
    }

    // Once we have finished the last round:
    if (this.rounds === 0) {
      this.announceFinalWinner();
    }
  }

  startGame() {
    this.getNumberOfRounds();
  }
}
