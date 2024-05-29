const express = require('express');
const {
createBarangayCertificate,
createBarangayIndigency,
createBarangayID,
confirmRequestPickup,
getAllRequests,
} = require('../controllers/adminController');
const router = express.Router();
router.post('/create-certificate', createBarangayCertificate);
router.post('/create-indigency', createBarangayIndigency);
router.post('/create-id', createBarangayID);
router.post('/confirm-pickup', confirmRequestPickup);
router.get('/requests', getAllRequests);
module.exports = router;