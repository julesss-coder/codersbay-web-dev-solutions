let numberOfRounds = document.querySelector(".number-of-rounds");
let currentRound = document.querySelector(".current-round");
let computerChoiceText = document.querySelector(".computer-choice-text");
let computerChoiceImg = document.querySelector(".computer-choice-img");
let userChoiceText = document.querySelector(".user-choice-text");
let userChoiceImg = document.querySelector(".user-choice-img");
let newGameBtn = document.querySelector(".new-game-btn");
let announcements = document.querySelector(".announcements");
let userScore = document.querySelector(".user-score");
let computerScore = document.querySelector(".computer-score");

// Event listeners
newGameBtn.addEventListener("click", () => {
  let newGame = new RockPaperScissors();
  newGame.startGame();  
});


class RockPaperScissors {
  constructor() {
    this.userScore = 0;
    this.computerScore = 0;
    this.rounds = 0;
    this.choices = ["rock", "paper", "scissors"];
    this.computerChoice;
    this.userChoice;
    this.roundWinner = "";
  }

  // Do I need getters and setters?

  // Methods
  getNumberOfRounds() {
    this.rounds = +prompt("How many rounds would you like to play? Enter an integer.", 1);
    numberOfRounds.textContent = this.rounds; // should not change during game bc method is only called in beginning of game
  }

  getComputerChoice() {
    this.computerChoice = this.choices[this.generateRandomNumber()];
    console.log("this.computerChoice: ", this.computerChoice);
  }

  getUserChoice() {
    // Can't I put `number` in the constructor, or not create a variable altogether?
    let number;
    while (number < 0 || number > 2 || typeof number !== "number") {
      number = +prompt("Enter: 0 for rock, 1 for paper, 2 for scissors", 1);
    }

    this.userChoice = this.choices[number];
  }

  generateRandomNumber() {
    return Math.floor(Math.random() * 3);
  }

  displayChoices() {
    computerChoiceText.textContent = "Computer's choice: " + this.computerChoice;
    userChoiceText.textContent = "User's choice: " + this.userChoice;
    // computerChoiceImg.style.backgroundImage = "url(`images/${this.computerChoice}.jpg`)";
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
      /*
      assign winner to this.roundWinner:
        + value is saved -> can be passed to separate method
        + separation of concerns

      console.log roundwinner directly:
        - makes code hard to read
        - does not separate concerns (announcing winner, getting winner)

      */
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
      console.log(`User score: ${this.userScore}, computer score: ${this.computerScore}. It's a tie.`);
      return;
    }

    this.userScore > this.computerScore ? console.log("User wins") : console.log("Computer wins");

  }

  startGame() {
    this.getNumberOfRounds();
    while (this.rounds > 0) {
      this.getComputerChoice();
      this.getUserChoice();
      this.rounds--;
      this.displayChoices();
      this.displayRounds();
      this.getRoundWinner();
    }
    this.announceFinalWinner();
  }
}

let newGame = new RockPaperScissors();
newGame.startGame();