//const data = [
//  {
//    reviewID: 4,
//    reviewTitle: 'test',
//    reviewDescription: 'wowwww',
//    reviewRating: 5,
//  },
//  {
//    reviewID: 5,
//    reviewTitle: 'test',
//    reviewDescription: 'amazing',
//    reviewRating: 4,
//  },
//]
const reviewContainer = document.querySelector('#reviews')
let rateBox = Array.from(document.querySelectorAll('.rate-box'))
let globalValue = document.querySelector('.global-value')
let two = document.querySelector('.two')
let totalReviews = document.querySelector('.total-reviews')
let reviews = { 5: 0, 4: 0, 3: 0, 2: 0, 1: 0 }

export function displayReviews(data){
//    const data = x;
    for (let review of data) {
        for (let i = 1; i < 6; i++) if (review.reviewRating === i) reviews[`${i}`]++;
        displayReview(review);
    }
    updateValues();
}



// ratings functions
function updateValues() {
  rateBox.forEach((box) => {
    let valueBox = rateBox[rateBox.indexOf(box)].querySelector('.value')
    let countBox = rateBox[rateBox.indexOf(box)].querySelector('.count')
    let progress = rateBox[rateBox.indexOf(box)].querySelector('.progress')
    console.log(typeof reviews[valueBox.innerHTML])
    countBox.innerHTML = nFormat(reviews[valueBox.innerHTML])

    let progressValue = Math.round(
      (reviews[valueBox.innerHTML] / getTotal(reviews)) * 100
    )
    progress.style.width = `${progressValue}%`
  })
  totalReviews.innerHTML = getTotal(reviews)
  finalRating()
}
function getTotal(reviews) {
  return Object.values(reviews).reduce((a, b) => a + b)
}

// document.querySelectorAll('.value').forEach((element) => {
//   element.addEventListener('click', () => {
//     let target = element.innerHTML
//     reviews[target] += 1
//     updateValues()
//   })
// })

function finalRating() {
  let final = Object.entries(reviews)
    .map((val) => val[0] * val[1])
    .reduce((a, b) => a + b)
  // console.log(typeof parseFloat(final / getTotal(reviews)).toFixed(1));
  let ratingValue = nFormat(parseFloat(final / getTotal(reviews)).toFixed(1))
  globalValue.innerHTML = ratingValue
  two.style.background = `linear-gradient(to right, #66bb6a ${
    (ratingValue / 5) * 100
  }%, transparent 0%)`
}

function nFormat(number) {
  if (number >= 1000 && number < 1000000) {
    return `${number.toString().slice(0, -3)}k`
  } else if (number >= 1000000 && number < 1000000000) {
    return `${number.toString().slice(0, -6)}m`
  } else if (number >= 1000000000) {
    return `${number.toString().slice(0, -9)}md`
  } else if (number === 'NaN') {
    return `0.0`
  } else {
    return number
  }
}

// review functions

function displayReview(review) {
  const stars = '<i class="fas fa-star"></i>'
  const emptyStar = '<i class="far fa-star"></i>'

  // Create DOM elements for the review card
  const reviewCard = document.createElement('div')
  reviewCard.classList.add('testimonial-box-container')
  reviewCard.innerHTML = `
    <div class="testimonial-box">
      <div class="box-top">
        <div class="profile">
          <div class="name-user">
            <strong>${review.reviewUsername}</strong>
          </div>
        </div>
        <div class="reviews">
          ${stars.repeat(review.reviewRating)}${emptyStar.repeat(
    5 - review.reviewRating
  )}
        </div>
      </div>
      <div class="client-comment">
        <p>${review.reviewDescription}</p>
      </div>
    </div>
  `

  // Append the review card to the div#review container
  reviewContainer.appendChild(reviewCard)
}
