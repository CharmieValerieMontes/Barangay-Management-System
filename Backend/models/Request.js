const mongoose = require('mongoose');
const RequestSchema = new mongoose.Schema({
 visitorId: { type: mongoose.Schema.Types.ObjectId, ref: 'Visitor' },
 type: String,
 status: { type: String, default: 'Pending' },
 details: String,
 purpose: String, // Add purpose field
 createdAt: { type: Date, default: Date.now },
});
module.exports = mongoose.model('Request', RequestSchema);