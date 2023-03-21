# 0. Understand the problem

## Original task description
Grundgerüst ist eine Seite mit neun nummerierten Feldern (Stell dir ein Spielbrett vor)
Aktuelle Spielstand wird dabei dadurch gekennzeichnet, dass das entsprechende Feld, auf dem der Spieler steht, mit einem farbigen Hintergrund markiert ist.
Wenn Spieler einen Zug durchführen will, muss er auf einen Button unter dem Spielfeld klicken
Daraufhin wird ihm eine Rechenaufgabe gestellt
Diese sollen jeweils auf Zufallswerten basieren
Grundsätzliche Rechenarten für jedes Feld sind fest vorgegeben (z.B.: Aufgabe 1 ist eine Addition (+), Aufgabe 2 ist eine Division (/), usw.)
Schwierigkeitsgrad soll immer weiter ansteigen
Wenn Spieler Aufgabe richtig gelöst hat, rückt er ein Feld vor
Wenn Ergebnis falsch ist, bleibt er auf der Position
Zweiter Button für Spiel neu starten

## Rewrite

### Description of UI:
board with fields, numbered from 1 to 9 (3 x 3):
// a field equals a level in this game
// current level is displayed by coloring the appropriate field
  one calculation type per field: // the types of calculcations were chosen and assigned to the fields by me
    1: addition
    2: subtraction
    3: multiplication
    4: division
    5: squaring (exponentiation to the second power) (Quadrieren)
    6: cubing (exponentiation to the third power) (Kubieren)
    7: percentage calculation (Prozentrechnung)
    8: square root (Quadratwurzel)
    9: cube root (Kubikwurzel)

Maths question field
Player input field
"Make a move" button under board
"New game" button

* how many players?
  * works with one player => one player

### How it works: 
If player clicks "make a move" button :
  Generate maths questions according to current level (see above):*
    Use random numbers
  Pose maths question to player:
    Display solution input field
    Player enters his solution
    If player solution is correct:
      Player goes to next level:
        Current field loses color
        Field of next level is colored
    Else:
      Level stays the same
    Current calculation disappears

    If level === 9:
      Player wins.

* Generate maths question:
  // decimal numbers: round to 3 decimal points (.toFixed(3))
  Level 1 - 4:
    generate random integers a and b
      // Use numbers between 0 (inclusive) and 101 (exclusive)
    calculation = string `a` `calculation type` `b` 
    result = result of calculation
    check against user input
  Level 5, 6, 8, 9: 
    generate random integer `a`
    calculation = string `a²/³` / symbol for square root/cube root of `a`
    result = Math.pow(`a`, 2) / Math.pow(`a`, 3) / Math.sqrt(`a`) / Math.cbrt(`a`)
  Level 7:
    generate random integers `a` and `b`
    calculation = string `a` % of `b`
    result = (`a`/100) * `b`

