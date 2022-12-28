import React from 'react';
import LeaveForm from '../user/ApplyLeave';
import { useEffect } from 'react';
import Navbar from '../components/Navbar';
import Sidebar from '../components/Sidebar';


const Leaves = () => {
    useEffect(() => {
      const checkAuth = async () => {
        try {
          const session = localStorage.getItem("session");
          if (!session) {
            throw new Error("Not authenticated");
          }
        } catch (err) {
          window.location.href = "/login";
        }
      };
      checkAuth();
    }, []);

    return (
        <div className="leaves-container">
            <h1>Leaves</h1>

            <div className="leave-box">
                <LeaveForm/>
            </div>
        </div>
    );
}

export default Leaves;
