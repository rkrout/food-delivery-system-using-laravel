export const getFormData = (values) => {
    const formData = new FormData()

    Object.keys(values).forEach(key => {

        if (typeof values[key] === "boolean") {
            values[key] = values[key] ? 1 : 0
        }

        formData.append(key, values[key])
    })

    return formData
}

export const currency = new Intl.NumberFormat('en-IN', {
    style: "currency",
    currency: "INR"
})