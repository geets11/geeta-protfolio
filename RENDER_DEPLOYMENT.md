# 🎨 Geeta's Portfolio - Render Deployment Guide

## 🚀 Quick Deploy

1. **Push to GitHub:**
   \`\`\`bash
   git remote add origin https://github.com/YOUR_USERNAME/geeta-portfolio.git
   git branch -M main
   git push -u origin main
   \`\`\`

2. **Deploy on Render:**
   - Go to [render.com](https://render.com)
   - Click "New +" → "Web Service"
   - Connect your GitHub repository
   - Render auto-detects `render.yaml`
   - Click "Deploy"

## 🔧 Configuration

### Environment Variables (Auto-configured)
- `APP_NAME`: "Geeta Portfolio"
- `APP_ENV`: production
- `APP_DEBUG`: false
- `ADMIN_EMAIL`: geetskuikel@gmail.com
- `ADMIN_PASSWORD`: 12345678

### 📧 Email Setup (Optional)
1. Enable 2FA on Gmail
2. Generate App Password
3. Add to Render dashboard:
   - `MAIL_PASSWORD`: your-16-char-app-password

## 🎯 Access Your Portfolio

- **Live Site**: `https://geeta-portfolio.onrender.com`
- **Admin Panel**: `https://geeta-portfolio.onrender.com/admin/login`

## 🔐 Admin Login
- Email: geetskuikel@gmail.com
- Password: 12345678

## 🛠️ Features

- ✅ Professional portfolio layout
- ✅ Contact form with admin panel
- ✅ Responsive design
- ✅ SQLite database
- ✅ Admin authentication
- ✅ Email notifications (with setup)
- ✅ Optimized for Render deployment

## 📱 Custom Domain

1. Go to Render dashboard
2. Select your service
3. Settings → Custom Domains
4. Add your domain
5. Update DNS records as instructed

## 🔍 Troubleshooting

- **Build fails**: Check logs in Render dashboard
- **Database issues**: SQLite is automatically created
- **Email not working**: Set up Gmail App Password
- **Admin can't login**: Check environment variables

## 📞 Support

If you need help, check the Render documentation or contact support.
