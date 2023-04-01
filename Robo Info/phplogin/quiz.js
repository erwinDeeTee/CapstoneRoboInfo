

const questions = [
  {
    question: "A Part of the computer that displays the output on the screen",
    answers: ["Mouse", "Keyboard", "Monitor"],
    correctAnswer: "Monitor"
  },
  {
    question: "What Alphabets touches the pinky finger in the keyboard",
    answers: ["QAZ", "WSX", "Spacebar"],
    correctAnswer: "QAZ"
  
  },
  {
    question: "What is the brain of the computer?",
    answers: ["Printer", "CPU", "Speaker"],
    correctAnswer: "CPU"
  },
  {
    question: "When was the first computer invented?",
    answers: ["1872", "1992", "1945"],
    correctAnswer: "1945"
  },
  {
    question: "Who invented the computers?",
    answers: ["Albert Einstein", "Charles Babbage", "Blaise Pascal"],
    correctAnswer: "Charles Babbage"
  }
];

let currentQuestion = 0;
let score = 0;
let quizCompleted = false;

function loadQuestion() {
  const question = questions[currentQuestion];
  document.getElementById("question").textContent = question.question;
  const answerDiv = document.getElementById("answers");
  answerDiv.innerHTML = "";
  answerDiv.classList.add("answer-buttons");
  for (let answer of question.answers) {
    const answerBtn = document.createElement("button");
  answerBtn.style.backgroundColor = "transparent";

    const answerText = document.createElement("span"); 
    answerText.textContent = answer;
    answerBtn.appendChild(answerText); 
    answerBtn.addEventListener("click", () => {
      for (let btn of answerDiv.children) {
        btn.disabled = true;
        const answerSpan = btn.querySelector("span"); 
        if (answerSpan.textContent === question.correctAnswer) {
          answerSpan.style.color = "green"; 
        }
        if (answerSpan.textContent !== question.correctAnswer && btn === answerBtn) {
          answerSpan.style.color = "red"; 
        }
      }
      if (answer === question.correctAnswer) {
        score++;
    
  
       
      }
      
      
      document.getElementById("score").textContent = `Score: ${score}`;
      if (currentQuestion === questions.length - 1) {
        document.getElementById("next-btn").textContent = "Restart";
        quizCompleted = true;
        if (score === questions.length) {
          document.getElementById("question").textContent = "Congratulations, Quiz Completed!";
          document.getElementById("answers").innerHTML = "";
          quizCompleted = false;
        }
      }
      document.getElementById("next-btn").disabled = false;
    });
    answerDiv.appendChild(answerBtn);
  }
  document.getElementById("next-btn").disabled = true;
}


loadQuestion();

document.getElementById("next-btn").addEventListener("click", () => {
  if (quizCompleted) {
    currentQuestion = 0;
    score = 0;
    quizCompleted = false;
    document.getElementById("next-btn").textContent = "Next";
  } else if (currentQuestion === questions.length - 1) {
    currentQuestion = 0;
    score = 0;
    document.getElementById("next-btn").textContent = "Next";
  } else {
    currentQuestion++;
  }
  document.getElementById("score").textContent = `Score: ${score}`;
  if (currentQuestion === questions.length) {
    document.getElementById("question").textContent = "Quiz complete!";
    document.getElementById("answers").innerHTML = "";
    document.getElementById("next-btn").disabled = true;
    
  } else {
    loadQuestion();
    
  }
});
