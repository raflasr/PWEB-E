// Define products and brands
const products = {
    Desktop: ["Dell", "HP", "Lenovo"],
    Laptop: ["Apple", "Asus", "Acer"],
    Smartphone: ["Samsung", "Xiaomi", "Oppo"]
};

// Update the brand dropdown based on the selected product type
function updateBrands() {
    const productType = document.getElementById('product-type').value;
    const brandDropdown = document.getElementById('brand');

    // Clear current options
    brandDropdown.innerHTML = '<option value="">Pilih Merk</option>';

    if (productType) {
        const brands = products[productType];

        // Add new options dynamically
        brands.forEach(brand => {
            const option = document.createElement('option');
            option.value = brand;
            option.text = brand;
            brandDropdown.add(option);
        });
    }
}