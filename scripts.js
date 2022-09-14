
let articleElement = []; 

document.querySelector("#search").addEventListener("click", () => {
	const articleNumber = document.querySelector("#articleNumber");
	request(articleNumber);
  })

 request = (articleNumber) => {
	let url = `/get-item/${articleNumber.value}`;
	fetch(url)
	.then(response => response.json())
	.then(article => articleElement = article)
	.then(article => showarticle(article))
 }
 

 showarticle = article => {
	document.getElementById("articleName").innerHTML = `Article: ${article.name}`;

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
	.then(response => response.text())
    .then((response) => {
      document.getElementById("demo").innerHTML = response;
   })
   .catch(err => console.log(err))
}
