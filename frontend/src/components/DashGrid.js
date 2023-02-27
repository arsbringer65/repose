import React, {useState, useEffect} from "react";
import axios from "axios"

// ICONS
import {
  FaUserFriends,
  FaRegPaperPlane,
  FaCheck,
  FaTrash,
} from "react-icons/fa";
import { BsInfoSquare } from "react-icons/bs";

// Style
import "../style/admin/dashgrid.css";

const DashGrid = () => {
  const [employeeCount, setEmployeeCount] = useState(null);
  const [requestCount, setRequestCount] = useState(null);
  const [pendingCount, setPendingCount] = useState(null);
  const [approvedCount, setApprovedCount] = useState(null);

  const getEmployeeCount = async () => {
    try {
      const res = await axios.get("http://localhost/repose/api/employeecounts");
      setEmployeeCount(res.data.total);
    } catch (err) {
      console.error(err);
    }
  };

  const getRequestCount = async () => {
    try {
      const response = await axios.get(
        "http://localhost/repose/api/requestcounts"
      );
      setRequestCount(response.data.total);
    } catch (err) {
      console.error(err);
    }
  };

  const getPendingCount = async () => {
    try {
      const response = await axios.get(
        "http://localhost/repose/api/pendingcounts/"
      );
      setPendingCount(response.data.total);
    } catch (err) {
      console.error(err);
    }
  };

  const getApprovedCount = async () => {
    try {
      const response = await axios.get(
        "http://localhost/repose/api/approvedcounts/"
      );
      setApprovedCount(response.data.total);
    } catch (err) {
      console.error(err);
    }
  };

  const getDeclinedCount = async () => {
    try {
      const response = await axios.get(
        "http://localhost/repose/api/declinecounts/"
      );
      setApprovedCount(response.data.total);
    } catch (err) {
      console.error(err);
    }
  };


  useEffect(() => {
    getEmployeeCount();
    getRequestCount();
    getPendingCount();
    getApprovedCount();
  }, []);

  return (
    <div className="grid-container">
      <div className="employee-grid">
        <div style={{ color: "black", fontSize: "50px" }} className="people">
          <FaUserFriends />
        </div>
        <div>
          <h2 className="employee">Employees</h2>
          <div className="count1">
            <h1>{employeeCount}</h1>
          </div>
        </div>
      </div>
      <div className="leaves-grid">
        <div style={{ color: "black", fontSize: "50px" }} className="plane">
          <FaRegPaperPlane />
        </div>
        <div>
          <h2 className="leave">Leaves</h2>
          <div className="count2">
            <h1>{requestCount}</h1>
          </div>
        </div>
      </div>
      <div className="approved-grid">
        <div style={{ color: "black", fontSize: "50px" }} className="check">
          <FaCheck />
        </div>
        <div>
          <h2 className="approved">Approved</h2>
          <div className="count3">
            <h1>{approvedCount}</h1>
          </div>
        </div>
      </div>
      <div className="pending-grid">
        <div style={{ color: "black", fontSize: "50px" }} className="info">
          <BsInfoSquare />
        </div>
        <div>
          <h2 className="pending">Pending</h2>
          <div className="count4">
            <h1>{pendingCount}</h1>
          </div>
        </div>
      </div>
      <div className="declined-grid">
        <div style={{ color: "black", fontSize: "50px" }} className="trash">
          <FaTrash />
        </div>
        <div>
          <h2 className="declined">Declined</h2>
          <div className="count5">
            <h1>00</h1>
          </div>
        </div>
      </div>
    </div>
  );
};

export default DashGrid;
