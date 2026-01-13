'use strict';

let MESSAGES = {
  message1: 'Bienvenue sur notre jeu.',
  message2: ' vous avez gagné !'
};

const PLAYER1 = "✔";
const PLAYER2 = "✗";

let start = null;
let timerIntervalId = null;

function main() {
  console.log(MESSAGES.message1);
  alert(MESSAGES.message1);

  // Events sur les 9 cases
  for (let i = 0; i < 9; i++) {
    const cell = document.getElementById(`cell${i}`);
    if (cell) cell.addEventListener('click', fill);
  }

  // Event sur le bouton vérifier
  const playBtn = document.getElementById('play');
  if (playBtn) playBtn.addEventListener('click', verify);

  // Démarre le timer
  start = new Date();
  if (timerIntervalId) clearInterval(timerIntervalId);
  timerIntervalId = setInterval(updateTimer, 1000);
  updateTimer();
}

/**
 * Remplissage :
 * - si vide OU déjà PLAYER2 => met PLAYER1 en vert
 * - sinon => met PLAYER2 en rouge
 */
function fill(event) {
  const cell = event.target;

  const content = cell.innerHTML.trim();
  if (content === "" || content === PLAYER2) {
    cell.innerHTML = PLAYER1;
    cell.style.color = "green";
  } else {
    cell.innerHTML = PLAYER2;
    cell.style.color = "red";
  }
}

function getCellMark(i) {
  const el = document.getElementById(`cell${i}`);
  return el ? el.innerHTML.trim() : "";
}

function verifyPlayer(playerMark) {
  const b = [];
  for (let i = 0; i < 9; i++) b.push(getCellMark(i));

  const lines = [
    [0, 1, 2], [3, 4, 5], [6, 7, 8], // lignes
    [0, 3, 6], [1, 4, 7], [2, 5, 8], // colonnes
    [0, 4, 8], [2, 4, 6]             // diagonales
  ];

  return lines.some(([a, c, d]) => b[a] === playerMark && b[c] === playerMark && b[d] === playerMark);
}

function isBoardFull() {
  for (let i = 0; i < 9; i++) {
    if (getCellMark(i) === "") return false;
  }
  return true;
}

function resetBoard() {
  for (let i = 0; i < 9; i++) {
    const cell = document.getElementById(`cell${i}`);
    if (!cell) continue;
    cell.innerHTML = "";
    cell.style.color = ""; // revient à la couleur CSS par défaut
  }

  // redémarrer le timer pour la nouvelle partie
  start = new Date();
  updateTimer();
}

function getPlayerName(playerIndex) {
  // index.html utilise name="player1" et name="player2"
  const input = document.querySelector(`input[name="player${playerIndex}"]`);
  const name = input ? input.value.trim() : "";
  return name !== "" ? name : `J${playerIndex}`;
}

function verify() {
  const p1Win = verifyPlayer(PLAYER1);
  const p2Win = verifyPlayer(PLAYER2);

  if (p1Win && !p2Win) {
    const name = getPlayerName(1);
    alert(`Bravo ${name}${MESSAGES.message2}`);
    addScore(name);
    resetBoard();
    return;
  }

  if (p2Win && !p1Win) {
    const name = getPlayerName(2);
    alert(`Bravo ${name}${MESSAGES.message2}`);
    addScore(name);
    resetBoard();
    return;
  }

  if (p1Win && p2Win) {
    alert("Situation incohérente : les deux joueurs gagnent.");
    return;
  }

  if (isBoardFull()) {
    alert("Égalité !");
    resetBoard();
    return;
  }

  alert("Personne n'a encore gagné.");
}

function addScore(name) {
  const table = document.getElementById('scores');
  if (!table) return;

  const row = table.insertRow(-1);
  const cellName = row.insertCell(0);
  const cellDate = row.insertCell(1);

  cellName.textContent = name;
  cellDate.textContent = new Date().toLocaleString();
}

function updateTimer() {
  const timerEl = document.getElementById('timer');
  if (!timerEl || !start) return;

  const now = new Date();
  const elapsedMs = now - start;

  const totalSeconds = Math.floor(elapsedMs / 1000);
  const minutes = Math.floor(totalSeconds / 60);
  const seconds = totalSeconds % 60;

  const mm = String(minutes).padStart(2, "0");
  const ss = String(seconds).padStart(2, "0");

  timerEl.textContent = `(${mm}:${ss})`;
}

// Lance main au bon moment (après chargement du HTML)
document.addEventListener('DOMContentLoaded', main);