import axios from "axios"
import { useEffect, useState } from "react"
import { useParams } from "react-router-dom"
import Loader from "../components/Loader"
import { toast } from "react-toastify"
import { currency } from "../utils/functions"

export default function OrderDetailsPage() {
    const { orderId } = useParams()

    const [deliveryAgents, setDeliveryAgents] = useState([])

    const [isSubmitting, setIsSubmitting] = useState(false)

    const [isLoading, setIsLoading] = useState(true)

    const [order, setOrder] = useState({})

    const [deliveryAgentId, setDeliveryAgentId] = useState()

    const [status, setStatus] = useState("")

    const { foods, deliveryAddress, paymentDetails } = order

    useEffect(() => {
        setDeliveryAgentId(order?.order?.deliveryAgentId)
        setStatus(order.order?.status)
    }, [order])

    const fetchDetails = async () => {
        const [ordersRes, deliveryAgentsRes] = await Promise.all([
            axios.get(`/orders/${orderId}`),
            axios.get("/delivery-agents")
        ])
// console.log(ordersRes.data);
// console.log(deliveryAgentsRes.data);

// return
        setOrder(ordersRes.data)

        setDeliveryAgents(deliveryAgentsRes.data)

        setIsLoading(false)
    }

    const handleSubmit = async (event) => {
        event.preventDefault()

        setIsSubmitting(true)

        await axios.patch(`/orders/${orderId}`, {
            delivery_agent_id: deliveryAgentId,
            status
        })

        toast.success("Order updated successfully")

        setIsSubmitting(false)
    }

    useEffect(() => {
        fetchDetails()
    }, [])

    if(isLoading) {
        return <Loader/>
    }

    return (
        <div className="order-details">
            <div className="card order-details-card">
                <h4 className="card-header card-title">Foods</h4>
                <div className="card-body order-details-body">
                    {foods.map(food => (
                        <p>{food.name} &times; {food.qty}</p>
                    ))}
                </div>
            </div>

            <div className="card order-details-card">
                <h4 className="card-header card-title">Address</h4>
                <div className="card-body order-details-body">
                    <p>Name : {deliveryAddress.name}</p>
                    <p>Street : {deliveryAddress.street}</p>
                    <p>Near : {deliveryAddress.landmark}</p>
                    <p>Mobile : {deliveryAddress.mobile} </p>
                    {deliveryAddress.instruction && <p>Instruction : {deliveryAddress.instruction}</p>}
                </div>
            </div>

            <div className="card order-details-card">
                <h4 className="card-header card-title">Payment Details</h4>
                <div className="card-body order-details-body">
                    <p>Food Price : {currency.format(paymentDetails.foodPrice)}</p>
                    <p>Gst : {paymentDetails.gstPercentage}%</p>
                    <p>Delivery Fee : {currency.format(paymentDetails.deliveryFee)}</p>
                </div>
            </div>

            <div className="card order-details-card">
                <h4 className="card-header card-title">Update</h4>

                <form className="card-body" onSubmit={handleSubmit}>
                    <div className="form-group">
                        <label htmlFor="deliveryAgentId" className="form-label">Delivery Agent</label>
                        <select
                            id="deliveryAgentId"
                            name="deliveryAgentId"
                            className="form-control"
                            value={deliveryAgentId}
                            onChange={event => setDeliveryAgentId(event.target.value)}
                            required
                        >
                            <option></option>
                            {deliveryAgents.map(deliveryAgent => (
                                <option value={deliveryAgent.id}>{deliveryAgent.name}</option>
                            ))}
                        </select>
                    </div>

                    <div className="form-group">
                        <label htmlFor="status" className="form-label">Status</label>
                        <select
                            id="status"
                            name="status"
                            className="form-control"
                            value={status}
                            onChange={event => setStatus(event.target.value)}
                            required
                        >
                            <option></option>
                            <option value="Placed">Placed</option>
                            <option value="Preparing">Preparing</option>
                            <option value="Prepared">Prepared</option>
                            <option value="Canceled">Canceled</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                    </div>

                    <button
                        type="submit"
                        disabled={isSubmitting}
                        className="btn btn-primary"
                    >
                        {isSubmitting ? "Please wait..." : "Save"}
                    </button>
                </form>
            </div>
        </div>
    )
}