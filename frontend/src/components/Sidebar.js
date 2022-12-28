import React from 'react';
import {FaBars} from 'react-icons/fa';
import { NavLink } from 'react-router-dom';
import { useState } from 'react';
// import Navbar from './Navbar';

const Sidebar = ({children}) => {
    const [isOpen, setIsOpen] = useState(false);
    const toggle = () => setIsOpen(!isOpen);


    const menuItem=[
        {
            path:"/",
            name:"Dashboard",
        },
        {
            path:"/leaves",
            name:"Leaves",
        },
        {
            path:"/calendar",
            name:"Calendar",
        },
        {
            path:"/applyleave",
            name:"ApplyLeave",
        },
    ]

    const handleLogout = async () => {
      try {
        localStorage.removeItem("session");
        window.location.href = "/login";
      } catch (err) {
        // handle error
      }
    };


    

    return (
      <>
        <div className="container">
          <div style={{ width: isOpen ? "200px" : "50px" }} className="sidebar">
            <div className="top_section">
              <div
                style={{ marginLeft: isOpen ? "112px" : "0px" }}
                className="bars"
              >
                <FaBars onClick={toggle} />
              </div>
            </div>
            {menuItem.map((item, index) => (
              <NavLink
                to={item.path}
                key={index}
                className="link"
                activeclassName="active"
              >
                <div className="icon">{item.icon}</div>
                <div
                  style={{ display: isOpen ? "block" : "none" }}
                  className="link_text"
                >
                  {item.name}
                </div>
              </NavLink>
            ))}
            <div className="link_text link icon sidebar" onClick={handleLogout}>
              Logout
            </div>
          </div>
          <main>{children}</main>
        </div>
      </>
    );
}

export default Sidebar;
