const rupiah = (number) => {
  return new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
  }).format(number);
};

const reverseRupiah = (rupiah) => {
  const cleaned = rupiah.replace(/[^\d,]/g, "");
  const normalized = cleaned.replace(/\./g, "").replace(/,/g, ".");
  const number = parseFloat(normalized);
  return number;
};
