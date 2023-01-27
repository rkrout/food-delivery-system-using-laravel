import { ErrorMessage, Field, Form, Formik } from 'formik'
import { useEffect, useRef, useState } from "react"
import { toast } from "react-toastify"
import Loader from '../components/Loader'
import axios from "../utils/axios"
import { getFormData } from '../utils/functions'
import { foodSchema } from '../utils/validationSchemas'



export default function CreateFoodPage() {
    const [categories, setCategories] = useState([])
    const [isLoading, setIsLoading] = useState(true)
    const imageRef = useRef()

    const fetchCategories = async () => {
        const { data } = await axios.get("/categories")

        setCategories(data)

        setIsLoading(false)
    }

    const handleSubmit = async (values, { setSubmitting, resetForm }) => {
        setSubmitting(true)

        try {
            await axios.post("/foods", getFormData(values))

            toast.success("Food created successfully")

            resetForm()

            imageRef.current.value = ""

        } catch ({ response }) {
            console.log(response);
            response.status === 422 && toast.error("Food already exists")
        }

        setSubmitting(false)
    }

    useEffect(() => {
        fetchCategories()
    }, [])

    if (isLoading) {
        return <Loader/>
    }

    return (
        <Formik
            initialValues={{
                name: "",
                price: "",
                categoryId: "",
                image_url: "",
                isVegan: true,
                isFeatured: true
            }}
            validationSchema={foodSchema}
            onSubmit={handleSubmit}
        >
            {({
                values,
                setFieldValue,
                isSubmitting
            }) => (

                <Form className="card form">
                    <div className="card-header card-header-title">Create food</div>

                    <div className="card-body">
                        <div className="form-group">
                            <label htmlFor="name" className="form-label">Name</label>
                            <Field
                                type="text"
                                id="name"
                                className="form-control"
                                name="name"
                            />
                            <ErrorMessage component="p" name="name" className="form-error" />
                        </div>

                        <div className="form-group">
                            <label htmlFor="price" className="form-label">Price</label>
                            <Field
                                type="number"
                                id="price"
                                className="form-control"
                                name="price"
                            />
                            <ErrorMessage component="p" name="price" className="form-error" />
                        </div>

                        <div className="form-group">
                            <label htmlFor="categoryId" className="form-label">Category</label>
                            <Field
                                id="categoryId"
                                className="form-control"
                                name="categoryId"
                                as="select"
                            >
                                <option></option>
                                {categories.map(category => (
                                    <option value={category.id}>{category.name}</option>
                                ))}
                            </Field>
                            <ErrorMessage component="p" name="categoryId" className="form-error" />
                        </div>

                        <div className="form-group">
                            <label htmlFor="image" className="form-label">Image</label>
                            <input
                                type="file"
                                id="image"
                                className="form-control"
                                name="image"
                                onChange={event => setFieldValue("image", event.target.files[0])}
                                ref={imageRef}
                                accept=".jpeg, .jpg, .png"
                            />
                        </div>
                        
                        <div className="form-check">
                            <Field
                                type="checkbox"
                                id="isVegan"
                                className="form-check-input"
                                name="isVegan"
                            />
                            <label htmlFor="isVegan">Vegan</label>
                        </div>

                        <div className="form-check">
                            <Field
                                type="checkbox"
                                id="isFeatured"
                                className="form-check-input"
                                name="isFeatured"
                            />
                            <label htmlFor="isFeatured">Featured</label>
                        </div>

                        <button
                            type="submit"
                            disabled={isSubmitting}
                            className="btn btn-primary"
                        >
                            {isSubmitting ? "Please wait..." : "Save"}
                        </button>
                    </div>
                </Form>
            )}
        </Formik>
    )
}