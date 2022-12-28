import React from "react";
import DashGrid from "../components/DashGrid";
import { useEffect } from "react";
import Navbar from "../components/Navbar";
import Sidebar from "../components/Sidebar";

const Dashboard = () => {
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
    <div className="ad-dash">
      <h1>Dashboard</h1>
      <div className="ad-container">
        <DashGrid />
      </div>
    </div>
  );
};

export default Dashboard;
