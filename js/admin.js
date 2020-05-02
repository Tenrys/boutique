function switchCategory() {
	let id = this.value;
	let category = categories.find(category => category.id == id);
	document.querySelector("input[name='category[name]']").value = category.name;
	document.querySelector("textarea[name='category[description]']").textContent = category.description;
}
function switchSubcategory() {
	let id = this.value;
	let subcategory = subcategories.find(subcategory => subcategory.id == id);
	document.querySelector("input[name='subcategory[name]']").value = subcategory.name;
	document.querySelector("textarea[name='subcategory[description]']").textContent = subcategory.description;
	if (subcategory.category) {
		document.querySelector("select[name='subcategory[category]']").value = subcategory.category.id;
	}
}
function switchProduct() {
	let id = this.value;
	let product = products.find(product => product.id == id);
	document.querySelector("input[name='product[name]']").value = product.name;
	document.querySelector("textarea[name='product[description]']").textContent = product.description;
	document.querySelector("input[name='product[price]']").value = product.price;
	document.querySelector("input[name='product[quantity]']").value = product.quantity;
	document.querySelector("select[name='product[subcategory]']").value = product.subcategory.id;
	document.querySelector("img[id='product-image']").src = `img/${product.imagePath}`;
}
function updateProductImage() {
	let img = document.querySelector("img[id='product-image']");
	img.src = URL.createObjectURL(this.files[0]);
	img.onload = function () {
		URL.revokeObjectURL(this.src); // free memory
	};
}

window.addEventListener("load", () => {
	[
		{ el: document.querySelector("select[name='category[id]']"), onChange: switchCategory },
		{ el: document.querySelector("select[name='subcategory[id]']"), onChange: switchSubcategory },
		{ el: document.querySelector("select[name='product[id]']"), onChange: switchProduct },
	].forEach(({ el, onChange }) => {
		el.size = Math.min(16, el.childElementCount);
		el.addEventListener("change", onChange);
		onChange.apply(el);
	});

	document.querySelector("input[name='product_img']").addEventListener("change", updateProductImage);
});
