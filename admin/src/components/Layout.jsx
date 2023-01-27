import { Outlet } from "react-router-dom"
import { useEffect, useState } from "react"
import NavBar from "./NavBar"
import SideBar from "./SideBar"
import useMediaQuery from "../hooks/useMediaQuery"

export default function Layout() {
    const isTablet = useMediaQuery("(max-width: 768px)")
    const [showSideBar, setShowSideBar] = useState(!isTablet)

    useEffect(() => {
        setShowSideBar(!isTablet)
    }, [isTablet])

    return (
        <div>
            <NavBar onMenuClick={() => setShowSideBar(!showSideBar)} />

            <SideBar show={showSideBar} onNavigate={() => isTablet && setShowSideBar(false)} />

            <div className="page-layout">
                <Outlet />
            </div>
        </div>
    )
}