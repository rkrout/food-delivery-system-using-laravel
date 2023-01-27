import { ErrorMessage, Field, Form, Formik } from 'formik'
import { useEffect, useState } from "react"
import { useLocation, useParams } from "react-router-dom"
import { toast } from "react-toastify"
import Loader from '../components/Loader'
import axios from "../utils/axios"
import { getFormData } from '../utils/functions'
import { foodSchema } from '../utils/validationSchemas'


export default function EditFoodPage() {
    const { foodId } = useParams()
    const { state } = useLocation()
    const [categories, setCategories] = useState([])
    // const [food, setFood] = useState({})
    const [isLoading, setIsLoading] = useState(true)

    const fetchData = async () => {
        const { data } = await axios.get("/categories")

        setCategories(data)

        setIsLoading(false)
    }

    const handleSubmit = async (values, { setSubmitting }) => {
        setSubmitting(true)

        try {
            await axios.patch(`/foods/${foodId}`, getFormData(values))

            toast.success("Food edited successfully")

        } catch ({ response }) {
            
            response?.status === 422 && toast.error("Food already exists")
        }

        setSubmitting(false)
    }

    useEffect(() => {
        fetchData()
    }, [])

    if (isLoading) {
        return <Loader/>
    }

    return (
        <Formik
            initialValues={{
                ...state,
                isVegan: state.isVegan == 1,
                isFeatured: state.isFeatured == 1,
            }}
            validationSchema={foodSchema}
            onSubmit={handleSubmit}
        >
            {({
                isSubmitting,
                setFieldValue
            }) => (

                <Form className="card form">
                    <div className="card-header card-header-title">Edit food</div>

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
                            {isSubmitting ? "Please wait..." : "Update"}
                        </button>
                    </div>
                </Form>
            )}
        </Formik>
    )
}