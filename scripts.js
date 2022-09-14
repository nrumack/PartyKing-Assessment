
let articleElement = []; 

document.querySelector("#search").addEventListener("click", () => {
	const articleNumber = document.querySelector("#articleNumber");
	request(articleNumber);
  })

 request = (articleNumber) => {
	let url = `/get-item/${articleNumber.value}`;
	fetch(url)
	.then((response) => {
		if (!response.ok) {
			alert("Please enter a valid article number");
		}
		return response.json();
	  })
	.then(article => articleElement = article)
	.then(article => showarticle(article))

 }


 showarticle = article => {
	document.getElementById("articleName").innerHTML = `${article.name}`;
	document.getElementById("articleDescription").innerHTML = `${article.articles[0].belongs_to_product.description}`;
console.log(article)

  }

async function SendItem(){
	await fetch("/get-box", {
	method: 'POST',
	headers: {
		'Accept': 'application/json',
		'Content-Type': 'application/json'
	  },
	body: `{
		"description": "${articleElement.name}",
		"height": ${articleElement.articles[0].height},
		"width": ${articleElement.articles[0].width},
		"depth": ${articleElement.articles[0].depth},
		"weight": ${articleElement.articles[0].weight}
	}`,
	})
	.then((response) => {
		if (!response.ok) {
			alert("It does not fit in any of our boxes");
		}
		return response.text();
	  })
    .then((response) => {
      document.getElementById("doesIt").innerHTML = response;
   })
   .catch(err => console.log(err))
}

/* 
{
	if (!response.ok) {
		alert("Please enter a valid article number");
	} 
  }) */